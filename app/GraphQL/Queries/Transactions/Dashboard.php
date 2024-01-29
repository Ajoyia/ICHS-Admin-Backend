<?php

namespace App\GraphQL\Queries\Transactions;

use App\Models\LoggerActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


final class Dashboard
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $dashboardData=[
            'revenue'=>[],
            'sales'=>[],
            'dailySales'=>[],
            'summary'=>[],
            'recentActivities'=>[],
            'transactions'=>[],
            'recentMemberships'=>[],
            'topSelling'=>[]
        ];
        $weekBefore=Carbon::now()->subDays(7);
        $data=DB::table('transaction_details')
            ->select(DB::raw('count(id) as models,sum(total_amount) as total,sum(total_amount_in_usd) as total_usd,model_type,MONTH(created_at) as month,YEAR(created_at) as year'))
            ->groupBy('model_type','month','year')
            ->whereIn('model_type',[
                'App\\Models\\CMEApplication',
                'App\\Models\\HealthInnovationInitiative',
                'App\\Models\\JournalApplication',
                'App\\Models\\AccredationApplication'
            ])
            ->whereYear('created_at',Carbon::now()->year)
            ->orderBy('month','asc')
            ->orderBy('model_type','asc')
            ->get();
        // return $data;
        $dashboardData['revenue']['cme_rev']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['cme_rev_usd']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['hii_rev']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['hii_rev_usd']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['jichs_rev']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['jichs_rev_usd']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['ic_rev']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['ic_rev_usd']=[0,0,0,0,0,0,0,0,0,0,0,0];
        $dashboardData['revenue']['total']=0;
        $dashboardData['revenue']['total_usd']=0;
        $dashboardData['sales']['cme']=0;
        $dashboardData['sales']['hii']=0;
        $dashboardData['sales']['jichs']=0;
        $dashboardData['sales']['ic']=0;
        foreach($data as $d){
            $dashboardData['revenue']['total']+=$d->total;
            $dashboardData['revenue']['total_usd']+=$d->total_usd;;
            switch($d->model_type){
                case 'App\\Models\\CMEApplication':
                    $dashboardData['revenue']['cme_rev'][$d->month-1]=$d->total;
                    $dashboardData['revenue']['cme_rev_usd'][$d->month-1]=$d->total_usd;
                    break;
                case 'App\\Models\\HealthInnovationInitiative':
                    $dashboardData['revenue']['hii_rev'][$d->month]=$d->total;
                    $dashboardData['revenue']['hii_rev_usd'][$d->month-1]=$d->total_usd;
                    break;
                case 'App\\Models\\JournalApplication':
                    $dashboardData['revenue']['jichs_rev'][$d->month]=$d->total;
                    $dashboardData['revenue']['jichs_rev_usd'][$d->month-1]=$d->total_usd;
                    break;
                case 'App\\Models\\AccredationApplication':
                    $dashboardData['revenue']['ic_rev'][$d->month]=$d->total;
                    $dashboardData['revenue']['ic_rev_usd'][$d->month-1]=$d->total_usd;
                    break;
            }
        }
        $dashboardData['sales']['cme']=DB::table('cme_applications')->select(DB::raw('count(id) as total'))->whereNull('deleted_at')->get()[0]->total;
        $dashboardData['sales']['hii']=DB::table('health_innovation_initiatives')->select(DB::raw('count(id) as total'))->whereNull('deleted_at')->get()[0]->total;
        $dashboardData['sales']['jichs']=DB::table('journal_applications')->select(DB::raw('count(id) as total'))->whereNull('deleted_at')->get()[0]->total;
        $dashboardData['sales']['ic']=DB::table('accredation_applications')->select(DB::raw('count(id) as total'))->whereNull('deleted_at')->get()[0]->total;
        $sales=DB::table('transaction_details')
            ->select(DB::raw('sum(total_amount) as total,sum(total_amount_in_usd) as total_usd,DATE(created_at) as day'))
            ->groupBy('day')
            ->where('created_at','>=',$weekBefore)
            ->get();
        $dashboardData['dailySales']['wd_0']=0;
        $dashboardData['dailySales']['wd_1']=0;
        $dashboardData['dailySales']['wd_2']=0;
        $dashboardData['dailySales']['wd_3']=0;
        $dashboardData['dailySales']['wd_4']=0;
        $dashboardData['dailySales']['wd_5']=0;
        $dashboardData['dailySales']['wd_6']=0;
        foreach($sales as $sale){
            $date=new Carbon($sale->day);
            $dashboardData['dailySales']['wd_'.$date->dayOfWeek]=$sale->total;
        }
        $sales=DB::table('transaction_details')
            ->select(DB::raw('sum(total_amount) as total,sum(total_amount_in_usd) as total_usd,DATE(created_at) as day'))
            ->groupBy('day')
            ->where('created_at','<=',$weekBefore)
            ->where('created_at','>=',$weekBefore->subDays(7))
            ->get();
        $dashboardData['dailySales']['l_wd_0']=0;
        $dashboardData['dailySales']['l_wd_1']=0;
        $dashboardData['dailySales']['l_wd_2']=0;
        $dashboardData['dailySales']['l_wd_3']=0;
        $dashboardData['dailySales']['l_wd_4']=0;
        $dashboardData['dailySales']['l_wd_5']=0;
        $dashboardData['dailySales']['l_wd_6']=0;
        foreach($sales as $sale){
            $date=new Carbon($sale->day);
            $dashboardData['dailySales']['l_wd_'.$date->dayOfWeek]=$sale->total;
        }

        $memberships=DB::table('memberships')
            ->join('membership_types','memberships.membership_type_id','=','membership_types.id')
            ->select(DB::raw('count(memberships.id) as members,membership_type_id,membership_types.name as member_ship_type'))
            ->groupBy('membership_type_id')
            ->get();
        foreach($memberships as $membership){
            $dashboardData['summary'][$membership->member_ship_type.'_memberships']=$membership->members;
        }
        $transactions=DB::table('transaction_details')
            ->join('users','transaction_details.user_id','=','users.id')
            ->select('users.first_name','users.last_name','transaction_details.created_at as created_at','transaction_details.total_amount','transaction_details.total_amount_in_usd')
            // ->where('model_type','App\\Models\\Donation')
            ->orderBy('transaction_details.id','desc')
            ->limit(6)
            ->get();
        foreach($transactions as $transaction){
            $transaction->initials=ucfirst(substr($transaction->first_name,0,1)).ucfirst(substr($transaction->last_name,0,1));
        }
        $dashboardData['transactions']=$transactions;

        $donations=DB::table('transaction_details')
            ->join('users','transaction_details.user_id','=','users.id')
            ->select('users.first_name','users.last_name','transaction_details.created_at as created_at','transaction_details.total_amount','transaction_details.total_amount_in_usd')
            ->where('model_type','App\\Models\\Donation')
            ->orderBy('transaction_details.id','desc')
            ->get();
        $dTotal=0;
        $dashboardData['donations']=[];
        foreach($donations as $donation){
            $dTotal+=$donation->total_amount_in_usd;
            array_push($dashboardData['donations'],$donation->total_amount_in_usd);
        }
        $dashboardData['dTotal']=$dTotal;
        $dashboardData['donations']=$donations;

        $memberships=DB::table('memberships')
            ->join('membership_types','memberships.membership_type_id','=','membership_types.id')
            ->join('users','memberships.user_id','=','users.id')
            ->join('transaction_details','transaction_details.model_id','=','memberships.id')
            ->select('users.first_name','users.last_name','users.image','membership_types.name','transaction_details.total_amount_in_usd','memberships.status')
            ->where('transaction_details.model_type','App\\Models\\Membership')
            ->orderBy('memberships.id','desc')
            ->limit(5)
            ->get();
        $dashboardData['recentMemberships']=$memberships;
        $sold=DB::select('
            select count(id) as count,"CME Applications" as type from cme_applications
            union
            select count(id) as count ,"HII" as type from health_innovation_initiatives
            union
            select count(id) as count ,"JICHS" as type from journal_applications
            union
            select count(id) as count ,"International Conference" as type from accredation_applications
            union
            select count(id) as count ,"Memberships" as type from memberships
            order by count desc'
        );
        // return $sold;
        $dashboardData['topSelling']=$sold;
        $dashboardData['ivlnCourses']=DB::select("
            select count(logs.id) as count,logs.model_type,logs.model_id,ivln_courses.name from logs
            inner join ivln_courses on logs.model_id=ivln_courses.id and logs.model_type='App\\\Models\\\IvlnCourse'
            where logs.model_type='App\\\Models\\\IvlnCourse'
            group by model_type,model_id
            order by count desc limit 5
        "
        );
        return $dashboardData;
    }
}
