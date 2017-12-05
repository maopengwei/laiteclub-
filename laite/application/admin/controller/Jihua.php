<?php
namespace app\admin\Controller;
use think\Controller;
use app\common\model\User;
use think\Db;
/**
* 计划控制器
*/
class Jihua extends Controller
{
	protected $user;
	function _initialize()
	{	
		parent::_initialize();
		$this->user = new User;
	}
	/**
	 * 日反
	 * 80是莱特币
	 * 10%是复消币
	 * 5%是ICO
	 * 5%是股权
	 * @return [type] [description]
	 */
	public function day_return(){
		$list = $this->user->where('status',1)->select();
		$system = Db::name('system')->find();
		$lite = $system['back']*$system['litecoin']/100;
		$after= $system['back']*$system['after']/100;
		$ico = $system['back']*$system['ico']/100;
		$stock = $system['back']*$system['stock']/100;
		foreach ($list as $k => $v) {
			$info = Db::name('detail')->where('uid',$v['id'])->find();
			$data = array(
				'litecoin_wallet' => $info['litecoin_wallet']+$lite,
				'ico_wallet' => $info['ico_wallet']+$ico,
				'aftercoin_wallet' => $info['aftercoin_wallet']+$after,
				'stock_wallet' => $info['stock_wallet']+$stock,
			);
			Db::name('detail')->where('uid',$v['id'])->update($data);
			$datb = array(
				'uid' => $v['id'],
				'litecoin' => $lite,
				'ico' => $ico,
				'after' => $after,
				'stock' => $stock,
				'add_time' => time(),
			);
			Db::name('litecoin_return')->insert($datb);
		}
	}
	/**
	 * 领导奖
	 * 10% 可以拿1--9代。每天都拿
	 */
	public function leader(){
		$list = $this->user->where('status',1)->select();
		foreach ($list as $k => $v) {
			$count = get_team_count($v['id'],9);
			$money = $count*0.013;
			$data = array(
				'uid' => $v['id'],
				'uid_two' => '',
				'num' => $money,
				'add_time' => time(),
				'type' => 2,
			);
			Db::name('litecoin_profit')->insert($data);
		}
	}
}