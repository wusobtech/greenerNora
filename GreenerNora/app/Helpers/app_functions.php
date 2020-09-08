<?php

use App\Cart;
use App\CartItem;
use App\OrderItem;
use App\User;
use App\Traits\Cart as TraitsCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


/** Returns a random alphanumeric token or number
 * @param int length
 * @param bool  type
 * @return String token
 */
function getRandomToken($length , $typeInt = false){
    if($typeInt == true){
        $token = Str::substr(rand(1000000000,9999999999), 0, $length) ;
    }
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}

/**Puts file in a public storage */
function putFileInStorage($file , $path ){
        $filename = uniqid().'.'.$file->getClientOriginalExtension();
        $file->storeAs($path , $filename);
        return $filename;
}

/**Puts file in a private storage */
function putFileInPrivateStorage($file , $path){
    $filename = uniqid().'.'.$file->getClientOriginalExtension();
    Storage::putFileAs($path,$file,$filename,'private');
    return $filename;
}

function resizeImageandSave($image ,$path , $disk = 'local', $width = 300 , $height = 300){
    // create new image with transparent background color
    $background = Image::canvas($width, $height, '#ffffff');

    // read image file and resize it to 262x54
    $img = Image::make($image);
    //Resize image
    $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });

    // insert resized image centered into background
    $background->insert($img, 'center');

    // save
    $filename = uniqid().'.'.$image->getClientOriginalExtension();
    $path = $path.'/'.$filename;
    Storage::disk($disk)->put($path, (string) $background->encode());
    return $filename;
}

// Returns full public path
function my_asset($path = null ){
    return route('homepage').env('ASSET_URL').'/'.$path;
}


/**Gets file from public storage */
function getFileFromStorage($fullpath , $storage = 'public'){
    if($storage == 'storage'){
        return route('read_file',encrypt($fullpath));
    }
    return my_asset($fullpath);
}

/**Deletes file from public storage */
function deleteFileFromStorage($path){
    unlink(public_path($path));
}


/**Deletes file from private storage */
function deleteFileFromPrivateStorage($path){
    $exists = Storage::disk('local')->exists($path);
    if($exists){
        Storage::delete($path);
    }
}


/**Downloads file from private storage */
function downloadFileFromPrivateStorage($path , $name){
    $name = $name ?? env('APP_NAME');
    $exists = Storage::disk('local')->exists($path);
    if($exists){
        $type = Storage::mimeType($path);
        $ext = explode('.',$path)[1];
        $display_name = $name.'.'.$ext;
        // dd($display_name);
        $headers = [
            'Content-Type' => $type,
        ];

        return Storage::download($path,$display_name,$headers);
    }
    return null;
}

function readPrivateFile($path){

}


/**Reads file from private storage */
function getFileFromPrivateStorage($fullpath , $disk = 'local'){
    if($disk == 'public'){
        $disk = null;
    }
    $exists = Storage::disk($disk)->exists($fullpath);
    if($exists){
        $fileContents = Storage::disk($disk)->get($fullpath);
        $content = Storage::mimeType($fullpath);
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', $content);
        return $response;
    }
    return null;
}



function str_limit($string , $limit = 20 , $end  = '...'){
    return Str::limit(strip_tags($string), $limit, $end);
}



/**Returns file size */
function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }


/** Returns File type
 * @return Image || Video || Document
 */
function getFileType(String $type)
    {
        $imageTypes = imageMimes() ;
        if(strpos($imageTypes,$type) !== false ){
            return 'Image';
        }

        $videoTypes = videoMimes() ;
        if(strpos($videoTypes,$type) !== false ){
            return 'Video';
        }

        $docTypes = docMimes() ;
        if(strpos($docTypes,$type) !== false ){
            return 'Document';
        }
    }

    function imageMimes(){
        return "image/jpeg,image/png,image/jpg,image/svg";
    }

    function videoMimes(){
        return "video/x-flv,video/mp4,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi";
    }

    function docMimes(){
        return "application/pdf,application/docx,application/doc";
    }


    function formatTime($minutes) {
        $seconds = $minutes * 60;
        $dtF = new DateTime("@0");
        $dtT = new DateTime("@$seconds");
        $a=$dtF->diff($dtT)->format('%a');
        $h=$dtF->diff($dtT)->format('%h');
        $i=$dtF->diff($dtT)->format('%i');
        $s=$dtF->diff($dtT)->format('%s');
        if($a>0)
        {
           return $dtF->diff($dtT)->format('%a days, %h hrs, %i mins and %s secs');
        }
        else if($h>0)
        {
            return $dtF->diff($dtT)->format('%h hrs, %i mins ');
        }
        else if($i>0)
        {
            return $dtF->diff($dtT)->format(' %i mins');
        }
        else
        {
            return $dtF->diff($dtT)->format('%s seconds');
        }
    }

    /** Returns cart details
     * @return object
     */
    function getUserCart(){
        $user = auth('web')->user();

        $cart = Cart::where('user_id', $user->id)->first();
        if(empty($cart)){
            $cart = Cart::create([
                'user_id' => $user->id,
                'price' => 0,
                'discount' => 0,
                'total' => 0,
                'items' => 0,
                'reference' => generateCartHash(),
            ]);
        }
        return $cart;
    }


    /** Refreshes cart details based on cart  items
     * @param int cart_id
     * @param bool generate_reference
     * @return cart object
     */
    function refreshCart($cart_id , $generate_reference = false){
        $cart = Cart::find($cart_id);
        $items = CartItem::where('cart_id' , $cart->id)->get();
        $price = 0;
        $discount = 0;
        $total = 0;
        $count = 0;
        foreach($items as $item){
            $count++;
            $price += $item->price;
            $discount += $item->discount;
            $total += ($item->price - $item->discount);
        }

        $cart->price = $price;
        $cart->discount = $discount;
        $cart->total = $total;
        $cart->items = $count;

        if($generate_reference){
            $cart->reference = generateCartHash();
        }
        $cart->save();

        session()->forget('my_courses');
        session()->forget('my_plans');

        return $cart;
    }

    function generateCartHash(){
        $token = getRandomToken(10);
        $check = Cart::where('reference',$token)->count();
        if($check == 0){
            return strtoupper($token);
        }
        return generateCartHash();
    }


    /** Checks if a course is in cart and returns item if found
     */
    function cartHasItem($product_id){
        return CartItem::where('cart_id', getUserCart()->id)->where('product_id' , $product_id)->first();
    }



    /**Returns formatted money value
     * @param float amount
     * @param int places
     * @param string symbol
     */
    function format_money($amount , $places = 2, $symbol = '$'){
        return $symbol.''.number_format((float)$amount ,$places);
    }


    function bloggerStats($blogger_id){
        $posts = Post::where('user_id' , $blogger_id)->get();
        $counts = 0;
        $likes = 0;
        $comments = 0;
            foreach($posts as $post){
                $counts++;
                $comments += $post->comments->count();
                $likes += $post->likes->count();
            }
        return [
            'likes' => $likes,
            'comments' => $comments,
            'posts' => $counts,
        ];
    }


    function getPlanDuration(){
        return [
            '1' => '1 Day',
            '3' => '3 Days',
            '7' => 'Week',
            '14' => '2 Weeks',
            '30' => 'Month',
            '60' => '2 Months',
            '90' => 'Quarter',
            '120' => '6 Months',
            '360' => 'Year',
            'Lifetime' => 'Lifetime',
        ];
    }


    function setActiveCourse($product_id){
        session()->put('active_product_id', $productid_);
    }
