<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use \Carbon\Carbon;
use App\Models\User;
use App\Models\UserWithdraw;
use App\Models\Visitor;
use App\Models\VisitorOrder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function me() {
        return Auth::guard('admin')->user();
    }
    public function loginPage(Request $request) {
        $myData = self::me();
        if ($myData != "") {
            return redirect()->route('admin.dashboard');
        }

        $message = Session::get('message');
        return view('login', [
            'request' => $request,
            'message' => $message
        ]);
    }
    public function login(Request $request) {
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$loggingIn) {
            return redirect()->route('admin.loginPage')->withErrors(['Kombinasi email dan password tidak tepat']);
        }

        $redirectTo = $request->r != "" ? $request->r : "admin.dashboard";
        return redirect()->route($redirectTo);
    }
    public function logout() {
        $loggingOut = Auth::guard('admin')->logout();
        return redirect()->route('admin.loginPage')->with(['message' => "Berhasil logout"]);
    }
    public function dashboard() {
        $myData = self::me();
        $now = Carbon::now();
        $startDate = $now->startOfMonth()->format('Y-m-d');
        $endDate = $now->endOfMonth()->format('Y-m-d');

        $revenueThisMonth = VisitorOrder::where('is_placed', 1)
        ->whereBetween('created_at', [$startDate, $endDate])->get('grand_total')->sum('grand_total');
        $customerThisMonth = Visitor::whereBetween('created_at', [$startDate, $endDate])->get('id')->count();
        $sellerThisMonth = User::whereBetween('created_at', [$startDate, $endDate])->get('id')->count();

        $startDate = $now->subMonth(6)->startOfMonth()->format('Y-m-d');
        $sellerGrowthRaw = User::whereBetween('created_at', [$startDate, $endDate])->get('created_at');
        $revenueGrowthRaw = VisitorOrder::where('is_placed', 1)
        ->whereBetween('created_at', [$startDate, $endDate])->get(['grand_total','created_at']);

        $sellerGrowth = [];
        $revenueGrowth = [];
        foreach ($sellerGrowthRaw as $data) {
            $dataMonth = Carbon::parse($data->created_at)->isoFormat('MMMM');
            if (array_key_exists($dataMonth, $sellerGrowth)) {
                $sellerGrowth[$dataMonth] += 1;
            } else {
                $sellerGrowth[$dataMonth] = 1;
            }
        }
        foreach ($revenueGrowthRaw as $data) {
            $dataMonth = Carbon::parse($data->created_at)->isoFormat('MMMM');
            if (array_key_exists($dataMonth, $revenueGrowth)) {
                $revenueGrowth[$dataMonth] += $data->grand_total;
            } else {
                $revenueGrowth[$dataMonth] = $data->grand_total;
            }

            $revenueGrowth[$dataMonth] = ($revenueGrowth[$dataMonth] / 1);
        }

        return view('dashboard', [
            'myData' => $myData,
            'revenueThisMonth' => $revenueThisMonth,
            'sellerThisMonth' => $sellerThisMonth,
            'customerThisMonth' => $customerThisMonth,
            'sellerGrowth' => $sellerGrowth,
            'revenueGrowth' => $revenueGrowth,
        ]);
    }
    public function profile() {
        $myData = self::me();
        return view('profile', [
            'myData' => $myData,
        ]);
    }
    public function withdrawal() {
        $myData = self::me();
        $datas = UserWithdraw::orderBy('created_at', 'DESC')->with(['user','bank'])->get();
        
        return view('withdrawal', [
            'myData' => $myData,
            'datas' => $datas,
        ]);
    }
    public function sales() {
        $myData = self::me();
        $orders = VisitorOrder::orderBy('created_at', 'DESC')->with(['details.digital_product_item','user','visitor'])
        ->paginate(25);
        
        return view('sales.Summary', [
            'myData' => $myData,
            'orders' => $orders
        ]);
    }
    public function seller(Request $request) {
        $myData = self::me();
        $filter = [];
        if($request->search != "") {
            $filter[] = [
                'name', 'LIKE', "%".$request->search."%"
            ];
        }
        if ($request->category != "") {
            $filter[] = [
                'categories', 'LIKE', "%".$request->category."%"
            ];
        }
        $users = User::where($filter)->orderBy('created_at', 'DESC')->paginate(25);

        $userCategories = User::get('categories');
        $sumCategories = [];
        foreach ($userCategories as $user) {
            if($user->categories != null) {
                $categories = explode(",", $user->categories);
                foreach ($categories as $i => $category) {
                    $isDataFound = false;
                    foreach ($sumCategories as $k => $sum) {
                        if ($sum['name'] == $category) {
                            $isDataFound = true;
                            $sumCategories[$k]['count'] += 1;
                        }
                    }
                    if (!$isDataFound) {
                        array_push($sumCategories, [
                            'name' => $category,
                            'count' => 1
                        ]);
                    }
                }
            }
        }

        usort($sumCategories, function($a, $b) {
            if($a['count']==$b['count']) return 0;
            return $a['count'] < $b['count']?1:-1;
        });

        $totalCategoryCount = array_sum(array_column($sumCategories, 'count'));

        foreach ($sumCategories as $i => $cat) {
            $percentage = $cat['count'] / $totalCategoryCount * 100;
            $sumCategories[$i]['percentage'] = $percentage;
        }

        $mostValuableSeller = User::withCount('orders')->orderBy('orders_count', 'desc')
        ->first();
        $recentSeller = User::orderBy('created_at', 'DESC')->first();

        return view('user.seller', [
            'myData' => $myData,
            'request' => $request,
            'sumCategories' => $sumCategories,
            'mostValuableSeller' => $mostValuableSeller,
            'recentSeller' => $recentSeller,
            'userCategories' => $userCategories,
            'users' => $users
        ]);
    }
    public function sellerDetail($id) {
        $myData = self::me();
        $seller = User::where('id', $id)
        ->first();

        $customers = Visitor::where('user_id', $seller->id);
        $countCustomer = $customers->get(['id'])->count();
        $customers = $customers->orderBy('created_at', 'DESC')->take(5)->get(['id','name','email','phone']);
        $transaction = VisitorOrder::where([
            ['user_id', $seller->id],
            ['is_placed', 1]
        ]);
        $countTransaction = $transaction->get('id')->count();
        $countRevenue = $transaction->get('grand_total')->sum('grand_total');

        $lastTransaction = $transaction->with('visitor')->orderBy('updated_at', 'DESC')->take(5)->get();

        return view('user.sellerDetail', [
            'myData' => $myData,
            'seller' => $seller,
            'countCustomer' => $countCustomer,
            'customers' => $customers,
            'countTransaction' => $countTransaction,
            'countRevenue' => $countRevenue,
            'lastTransaction' => $lastTransaction,
        ]);
    }
    public function customer(Request $request) {
        $myData = self::me();
        $now = Carbon::now();
        $filter = [];
        if ($request->search != "") {
            $filter[] = [
                'name', 'LIKE', "%".$request->search."%"
            ];
        }

        $customer = Visitor::where($filter)->orderBy('created_at', 'DESC');
        $countCustomer = $customer->get('id')->count();
        $customers = $customer->with('user')->paginate(25);

        $mostValuableCustomer = Visitor::withCount('orders')->orderBy('orders_count', 'desc')
        ->first();
        $recentCustomer = $customer->whereBetween('created_at', [
            $now->startOfMonth()->format('Y-m-d'),
            $now->endOfMonth()->format('Y-m-d')
        ])->get();

        return view('user.customer', [
            'myData' => $myData,
            'request' => $request,
            'customers' => $customers,
            'countCustomer' => $countCustomer,
            'mostValuableCustomer' => $mostValuableCustomer,
            'recentCustomer' => $recentCustomer,
        ]);
    }
}
