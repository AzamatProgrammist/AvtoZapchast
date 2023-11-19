<?php 

namespace App\Services;

use App\Repositories\Interfaces\MainOrderRepositoryInterface;
use Carbon\Carbon;
use App\Models\MainOrder;

class MainOrderService
{
	public $mainOrderInterface;
	public function __construct(MainOrderRepositoryInterface $mainOrderInterface)
	{
		$this->mainOrderInterface = $mainOrderInterface;
	}

	public function paginate()
	{
		return $this->mainOrderInterface->paginated();
	}

	public function getMainOrder($id)
	{
		return $this->mainOrderInterface->getMainOrder($id);
	}

	public function update($request, $id)
	{
		$main_order = $this->mainOrderInterface->getMainOrder($id);
        $main_order->status = $request->status;
        $main_order->update();
	}

	public function status()
	{
		$date = Carbon::now()->subDays(30);
        $date2 = Carbon::now()->subDays(90);
        $date3 = Carbon::now()->subDays(120);
        $oneMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date)->get();
        $threeMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date2)->get();
        $sixMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date3)->get();
        return [
        	"one" => $oneMonths,
        	"tree" => $threeMonths,
        	"six" => $sixMonths,
        ];
	}

}

 ?>