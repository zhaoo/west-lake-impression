<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');
        $uvModel = model('Uv');
        $pvModel = model('Pv');
        $uvAll = $uvModel->getAllUVNum();
        $pvAll = $pvModel->getAllPVNum();
        $uvToday = $uvModel->getTodayUVNum();
        $pvToday = $pvModel->getTodayPVNum();
        $seventtime = \fast\Date::unixtime('day', -7);
        $uvLast = $pvLast = [];
        $uvRes = $uvModel->getLastUVNum();
        $pvRes = $pvModel->getLastPVNum();
        for ($i = 0; $i < 7; $i++) {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $uvLast[$day] = $uvRes[6-$i];
            $pvLast[$day] = $pvRes[6-$i];
        }
        $newsModel = model('News');
        $newsNum = $newsModel->getNewsNum();
        $this->view->assign([
            'uvall'            => $uvAll,
            'pvall'            => $pvAll,
            'uvlast'           => $uvLast,
            'pvlast'           => $pvLast,
            'uvtoday'          => $uvToday,
            'pvtoday'          => $pvToday,
            'newsnum'          => $newsNum,
            'totalorder'       => 32143,
            'totalorderamount' => 174800,
            'todayorder'       => 2324,
            'unsettleorder'    => 132,
            'sevendnu'         => '80%',
            'sevendau'         => '32%',
            'addonversion'     => $addonVersion,
            'uploadmode'       => $uploadmode
        ]);
        return $this->view->fetch();
    }

}
