<?php 

namespace App\Services\Member;

use App\Http\Livewire\Members;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberService
{   
    const USER_ALREADY_EXIST = "This user already exist.";

    /**
     * Create member
     * @param array $request
     * @return bool
     */
    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $userDetails = User::where('introducer_key', $request['introducer_key'])->first();

            $user_id = auth()->user()->id;
            if(!empty($userDetails)) {
                $user_id = $userDetails->id;
            }

            $user['introducer_key'] = $request['introducer_id'];
            $user['name']           = $request['name'];
            $user['email']          = $request['email'];
            $user['date_of_birth']  = $request['date_of_birth'];
            $user['mobile']         = $request['mobile'];
            $user['gender']         = $request['gender'];
            $user['pan_number']     = $request['pan_number'];
            $user['password']       = Hash::make($request['password']);

            $userData = User::create($user);

            // Retrive user data as per user ID
            $user = User::with(['referrals' => function ($query) use ($request) {
                $query->where('position', $request['position'])
                    ->latest()
                    ->first();
            }])->find($user_id);

            $userReferral['user_id']        = $userData->id;
            $userReferral['position']       = $request['position'];
            // $userReferral['parent_id']      = (!empty($lastUser)) ? $lastUser->parent_id : $user_id;
            $userReferral['parent_id']      = (!empty($user->referrals[0]->user_id)) ? $user->referrals[0]->user_id : $user_id;
            $userReferral['referral_id']    = $user_id;

            $userRelerral = UserReferral::create($userReferral);
            
            if ($userRelerral) {
                return true;
            }
        });
    }

    /**
     * Show network list
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::with('referrals', 'referrals.referralUsers')->where('id',$user_id)->paginate(5);
        // $user = User::with('referrals', 'referrals.referralUsers')->where('id', $user_id)->get();

        return $user;
    }

    /**
     * Show $introducer_key
     * @param string $introducer_key
     */
    public function show($introducer_key)
    {
        $user = User::with('referrals')->where('introducer_key',$introducer_key)->first();
        return $user;
    }

    /**
     * Add yout network to another network
     * @param $request
     */
    public function addMyNetwork($request)
    {
        $user_id = auth()->user()->id;
        $userReferral = UserReferral::where('user_id', $request->id)->where('referral_id', $user_id)->first();
        if( !empty($userReferral)) {
            return static::USER_ALREADY_EXIST;
        } else {
            // Retrive user data as per user ID
            $user = User::with(['referrals' => function ($query) use ($request) {
                $query->where('position', $request->position)
                    ->latest()
                    ->first();
            }])->find($user_id);
    
            $userReferral['user_id']        = $request->id;
            $userReferral['position']       = $request->position;
    
            $userReferral['parent_id']      = (!empty($user->referrals[0]->user_id)) ? $user->referrals[0]->user_id : $user_id;
            $userReferral['referral_id']    = $user_id;
    
            $userRelerral = UserReferral::create($userReferral);
            
            if ($userRelerral) {
                return true;
            }
        }
    }
}