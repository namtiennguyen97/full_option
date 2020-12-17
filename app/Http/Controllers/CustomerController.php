<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return view('customer.index', compact('customer'));
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->full_name = $request->input('full_name');
        $customer->age = $request->input('age');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        if ($request->hasFile('image')) {
            $image1 = $request->file('image');
//            $new_name = rand(). '.' . $image1->getClientOriginalExtension();
            $path = $image1->store('images', 'public');
//            return response()->json([
//                'requested_image'=> '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />'
//            ]);
            $customer->image = $path;
        }
        $customer->save();

        return response()->json($customer);

    }


    public function searching(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $output = '';

            if ($query != '') {
                $data = DB::table('customer')->where('name', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('full_name', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')->get();
            } else {
                $data = DB::table('customer')
                    ->orderBy('id', 'desc')
                    ->get();
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .='
        <tr>
         <td>' . $row->name . '</td>
         <td>' . $row->full_name . '</td>
          <td>' . $row->age . '</td>
         <td>' . $row->phone . '</td>
         <td>' . $row->address . '</td>
         <td><img width="100" src="storage/' . $row->image . '" class="img-thumbnail"></td>
         <td><i class="fa fa-trash btn btn-danger deleteCustomer" data-id=" '. $row->id .' " aria-hidden="true"></i></td>
        </tr>
        ';
                }
            }
            else{
                $output = '<h3 align="center">No data Found</h3>';
            }

            $data = array(
                'total_data' => $output,
                'total_column' => $total_row
            );
            return json_encode($data);
        }
    }

    public function destroy($id){
        $output = '';
        $customer = Customer::find($id);
        $image = $customer->image;
        if ($image){
            Storage::delete('/public/'. $image);
        }
        $customer->delete();

        $data = DB::table('customer')->orderBy('id','desc')->get();

//        if ($customer->delete() == true){
            foreach ($data as $row){
                $output  .='
        <tr>
         <td>' . $row->name . '</td>
         <td>' . $row->full_name . '</td>
          <td>' . $row->age . '</td>
         <td>' . $row->phone . '</td>
         <td>' . $row->address . '</td>
         <td><img width="100" src="storage/' . $row->image . '" class="img-thumbnail"></td>
          <td><i class="fa fa-trash btn btn-danger deleteCustomer" data-id=" '. $row->id.' " aria-hidden="true"></i></td>
        </tr>
        ';
            }
//        }
        $data = array(
            'total_data' => $output
        );
        return json_encode($data);
    }

}
