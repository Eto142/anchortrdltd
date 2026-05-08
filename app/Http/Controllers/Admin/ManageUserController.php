<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Profit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageUserController extends Controller
{
    public function ManageUsers()
    {
        $users = User::paginate(10);
        
        if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.partials.users_table', ['users' => $users])->render(),
                'pagination' => $users->links()->render()
            ]);
        }
        
        return view('admin.manage_users', ['users' => $users]);
    }

    public function ShowUsers () {

        return view('admin.user_data');
    }




public function userProfile($id)
{
    $user = DB::table('users')->where('id', $id)->first();

    $deposits          = Deposit::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    $total_deposits    = Deposit::where('user_id', $id)->where('status', 1)->sum('amount');

    $profits           = Profit::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    $total_profits     = Profit::where('user_id', $id)->sum('amount');

    $withdrawals       = Withdrawal::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    $total_withdrawals = Withdrawal::where('user_id', $id)->where('status', 1)->sum('amount');

    // Balance = approved deposits + all profits - approved withdrawals
    $balance_amount = $total_deposits + $total_profits - $total_withdrawals;

    $data = [
        'userProfile'       => $user,
        'balance_amount'    => $balance_amount,
        'deposits'          => $deposits,
        'total_deposits'    => $total_deposits,
        'profits'           => $profits,
        'total_profits'     => $total_profits,
        'withdrawals'       => $withdrawals,
        'total_withdrawals' => $total_withdrawals,
    ];

    return view('admin.user_data', $data);
}



        public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();


        return back()->with('status', 'User deleted successfully');
}




    public function addTransaction(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->transaction_id = $request->transaction_id;
    $user->transaction_type = $request->transaction_type;
    $user->escrow_amount = $request->escrow_amount;
    $user->service_fee = $request->service_fee;
    $user->total_amount = $request->total_amount;

    $user->save();

    return redirect()->back()->with('success', 'Transaction details updated successfully.');
}


 public function WithdrawalTaxCode(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->withdrawal_tax_code = $request->withdrawal_tax_code;

    $user->save();

    return redirect()->back()->with('success', 'Withdrawal Tax code updated successfully.');
}


public function WithdrawalStatus(Request $request, $id)
{
    $request->validate([
        'withdrawal_status' => 'required|in:0,1'
    ]);

    $user = User::findOrFail($id);
    $user->withdrawal_status = $request->withdrawal_status;
    $user->save();

    return redirect()->back()->with('success', 'Withdrawal Status updated successfully.');
}







public function toggleSuspend(Request $request, User $user)
{
    $user->suspended = $user->suspended == 1 ? 0 : 1;
    $user->save();

    return response()->json([
        'success' => true,
        'status' => $user->suspended,
        'message' => $user->suspended ? 'User suspended successfully.' : 'User unsuspended successfully.'
    ]);
}





public function ConvertStatus(Request $request, $id)
{
    $request->validate([
        'conversion_status' => 'required|in:0,1'
    ]);

    $user = User::findOrFail($id);
    $user->conversion_status = $request->conversion_status;
    $user->save();

    return redirect()->back()->with('success', 'Convert Status updated successfully.');
}


public function SuspendUser(Request $request, $id)
{
    $request->validate([
        'suspended' => 'required|in:0,1',
    ]);

    $user = User::findOrFail($id);
    $user->suspended = $request->suspended;
    $user->save();

    return redirect()->back()->with('success', 'User suspended status updated successfully.');
}






}





