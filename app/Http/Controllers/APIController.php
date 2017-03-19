<?php
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Student;
    use Maatwebsite\Excel\Facades\Excel;
    class APIController extends Controller
    {
        public function index(Request $request)
        {
            
            //$products = Student::paginate(5);
             $pro=Excel::load('students.csv', function($reader) {

            //     // Getting all results
                 $products = $reader->get();
                    return $products;
                 // ->all() is a wrapper for ->get() and will work the same
              //$products = $reader->all();

             });
            return response(array(
                    'error' => false,
                    'products' =>$pro->toArray(),
                   ),200);       
        }
        public function store(Request $request)
        {
            // Student::create($request->all());
            // return response(array(
            //         'error' => false,
            //         'message' =>'Product created successfully',
            //        ),200);
            $file_handle = fopen("students.csv", "r");


                while (!feof($file_handle) ) {

                    $line_of_text = fgetcsv($file_handle, 1024);
                    if($request->email=$line_of_text[6]){
                       return "Email already taken";    
                    }

                }

                fclose($file_handle);

            $my_array_data= array($request->id,$request->firstName,$request->middleName,$request->lastName,$request->age,$request->grade,$request->email,$request->created_at,$request->updated_at);
            $handle = fopen("students.csv", "a");
            fputcsv($handle, $my_array_data);
            fclose($handle);
        }
        public function show($id)
        {
            // $product = Student::find($id);
            // return response(array(
            //         'error' => false,
            //         'product' =>$product,
            //        ),200);
             $file_handle = fopen("students.csv", "r");


                while (!feof($file_handle) ) {

                $line_of_text = fgetcsv($file_handle, 1024);
                    if($line_of_text[0]==$id){
                        $arr=array('id'=>$line_of_text[0],'firstName'=>$line_of_text[1],'middleName'=>$line_of_text[2],'lastName'=>$line_of_text[3],'age'=>$line_of_text[4],'grade'=>$line_of_text[5],'email'=>$line_of_text[6],'created_at'=>$line_of_text[7],'updated_at'=>$line_of_text[8]);
                        return json_encode($arr);    
                    }

                }

                fclose($file_handle);
            // return response(array(
            //         'error' => false,
            //         'products' =>$pro->toArray(),
            //        ),200);      
        }
        public function destroy($id)
        {
            Student::find($id)->delete();
            return response(array(
                    'error' => false,
                    'message' =>'Product deleted successfully',
                   ),200);
        }
    }
    ?>