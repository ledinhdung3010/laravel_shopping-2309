<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostProductRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\ProductSize;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use App\Rules\SalePriceValidate;
use App\Models\Product;
use App\Helper\CommonHelper;
use App\Models\ProductColor;
use App\Pagination\CustomPaginator;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $keyword = $request->query('s');
    $product = Product::where('name', 'LIKE', "%{$keyword}%")->orderBy('id','desc')->paginate(2);
    return view('admin.product.index', ['products' => $product, 'keyword' => $keyword]);
  }
  public function add()
  {
    $category = Category::where(['status' => 1])->get();
    $size = Size::where(['status' => 1])->get();
    $color = Color::where(['status' => 1])->get();
    $tag = Tag::where(['status' => 1, 'type' => 1])->get();
    return view('admin.product.add', [
      'categorys' => $category,
      'sizes' => $size,
      'colors' => $color,
      'tags' => $tag
    ]);
  }
  public function create(StorePostProductRequest $request)
  {
    $checkInSale = $request->input('in_sale');
    if ($checkInSale == 'on') {
      $validator = Validator::make($request->all(), [
        'sale_price' => ['nullable', 'required', 'numeric', new SalePriceValidate]
      ], [
        'sale_price.required' => 'vui long nhap gia khuyen mai',
        'sale_price.numeric' => 'gia khuyen mai phai la so'
      ]);
      if ($validator->fails()) {
        return redirect()->route('admin.product.add')->withErrors($validator)->withInput();
      }
      $price = $request->input('price');
      $salePrice = $request->input('sale_price');
      if ($salePrice > $price) {
        return redirect()->back()->with('error_sale--price', 'gia sale nho hon gia goc')->withInput();
      }
    }
    $arrayImg = [];
    if ($request->hasFile('list_image')) {
      foreach ($request->file('list_image') as $img) {
        $nameImg = $img->getClientOriginalName();
        $img->move(public_path('upload/images/product'), $nameImg);
        $arrayImg[] = $nameImg;
      }

      if (empty($arrayImg)) {
        return redirect()->back()->withErrors('error_upload_img', 'khong the upload anh')->withInput();
      }
    }
    // tien hanh insert vao sql

    $slug = CommonHelper::slugVietnamese($request->name);
    $product = new Product;
    $product->name = $request->name;
    $product->categories_id = $request->category_id;
    $product->slug = $slug;
    $product->description = ($request->description);
    $product->summary = $request->summary;
    $product->price = $request->price;
    $product->is_sale = $request->in_sale == 'on' ? '1' : '0';
    $product->sale_price = $request->in_sale == "on" ? $request->sale_price : `NULL`;
    $product->quantity = $request->quantity;
    $product->image = array_shift($arrayImg);
    $product->list_image = json_encode($arrayImg);
    $product->status = $request->status;
    $product->save();
    $lastInsertProduct = $product->id;
    if (is_numeric($lastInsertProduct) && $lastInsertProduct > 0) {
      $arrColorId = $request->color_id;
      $dataProductColor = [];
      if (is_array($arrColorId) && !empty($arrColorId)) {
        foreach ($arrColorId as $color_id) {
          $dataProductColor[] = [
            'product_id' => $lastInsertProduct,
            'color_id' => $color_id,
            'created_at' => date('Y-m-d H:i:s')
          ];
        }
        if (!empty($dataProductColor)) {
          ProductColor::insert($dataProductColor);
        }
        $arrSizeId = $request->size_id;
        $dataProductSize = [];
        if (is_array($arrSizeId) && !empty($arrSizeId)) {
          foreach ($arrSizeId as $size_id) {
            $dataProductSize[] = [
              'product_id' => $lastInsertProduct,
              'size_id' => $size_id,
              'created_at' => date('Y-m-d H:i:s')
            ];
          }
          if (!empty($dataProductSize)) {
            ProductSize::insert($dataProductSize);
          }
          $arrTagId = $request->tag_id;
          $dataProductTag = [];
          if (is_array($arrTagId) && !empty($arrTagId)) {
            foreach ($arrTagId as $tag_id) {
              $dataProductTag[] = [
                'product_id' => $lastInsertProduct,
                'tag_id' => $tag_id,
                'created_at' => date('Y-m-d H:i:s')
              ];
            }
            if (!empty($dataProductTag)) {
              ProductTag::insert($dataProductTag);
            }
            return redirect()->route('admin.product')->with('insert_success', 'insert success');
          }
        } else {
          return redirect()->back()->with('error_insert--product', 'insert product fail');
        }
      }

    }
  }
  public function delete(Request $request)
  {
    $idProduct = $request->id;
    $infoPD = Product::find($idProduct);
    if (!empty($infoPD)) {
      $infoPD->delete(); // tu update deleted_at ma khong xoa du lieu\
      return redirect()->back()->with('delete_success', 'delete success');
    }

  }
  public function edit(Request $request)
  {
    $idProduct = $request->id;
    $idProduct = is_numeric($idProduct) ? $idProduct : 0;
    $infoPD = Product::find($idProduct);
    $category = Category::where(['status' => 1])->get();
    $size = Size::where(['status' => 1])->get();
    $color = Color::where(['status' => 1])->get();
    $tag = Tag::where(['status' => 1, 'type' => 1])->get();

    if (empty($infoPD)) {
      return view('admin.product.error');
    } else {
      // su ly de hien thi danh sach anh
      $galleryImage = $infoPD->list_image;
      $arrGalleryImage = [];
      $arrGalleryImageView=[];
      if (!empty($galleryImage)) {
        $arrGalleryImage = json_decode($galleryImage);
        foreach($arrGalleryImage as $key=>$img){
            $arrGalleryImageView[]=[
              'id'=>$img,
              'src'=>URL::to('/')."/upload/images/product/".$img
            ];
        }
        
      }


      $arrColor = ProductColor::select('color_id')->where('product_id', $idProduct)->get();
      $arrColor = !empty($arrColor) ? array_column($arrColor->toArray(), 'color_id') : [];
      $arrSize = ProductSize::select('size_id')->where('product_id', $idProduct)->get();
      $arrSize = !empty($arrSize) ? array_column($arrSize->toArray(), 'size_id') : [];
      $arrTag = ProductTag::select('tag_id')->where('product_id', $idProduct)->get();
      $arrTag = !empty($arrTag) ? array_column($arrTag->toArray(), 'tag_id') : [];

      return view('admin.product.edit', [
        'categorys' => $category,
        'sizes' => $size,
        'colors' => $color,
        'tags' => $tag,
        'infoPD' => $infoPD,
        'arrGalleryImage' => $arrGalleryImage,
        'arrColor' => $arrColor,
        'arrSize' => $arrSize,
        'arrTag' => $arrTag,
        'viewImage'=>json_encode($arrGalleryImageView)
      ]);
    }

  }

  public function update(UpdatePostRequest $request)
  {
    $idProduct = $request->id;
    $idProduct = is_numeric($idProduct) ? $idProduct : 0;
    $infoPD = Product::find($idProduct);
    if (empty($infoPD)) {
      return redirect()->back()->with('error_update--product', 'update fail');
    } else {
      $checkInSale = $request->input('in_sale');
      if ($checkInSale == 'on') {
        $validator = Validator::make($request->all(), [
          'sale_price' => ['nullable', 'required', 'numeric', new SalePriceValidate]
        ], [
          'sale_price.required' => 'vui long nhap gia khuyen mai',
          'sale_price.numeric' => 'gia khuyen mai phai la so'
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        $price = $request->input('price');
        $salePrice = $request->input('sale_price');
        if ($salePrice > $price) {
          return redirect()->back()->with('error_sale--price', 'gia sale nho hon gia goc')->withInput();
        }
      }
      $arrayImg = [];
      if ($request->hasFile('list_image')) {
        $validateImg = Validator::make(
          $request->all(),
          [
            'list_image' => ['required', 'max:2048'],
            'list_image.*' => 'mimes:png,jpg,svg'
          ],
          [
            'list_image.required' => 'vui long chon anh san pham',
            'list_image.*.mimes' => 'dinh dang anh sai anh chap nhan jpg,svg,png',
            'list_image.max' => 'kich thuoc size qua lon'
          ]
        );
        if ($validateImg->fails()) {
          return redirect()->back()->withErrors($validateImg)->withInput();
        }
        // anh cu
        $arrOldImage=$request->old_list_image;

        foreach ($request->file('list_image') as $img) {
          $nameImg = $img->getClientOriginalName();
          $img->move(public_path('upload/images/product'), $nameImg);
          $arrayImg[] = $nameImg;
        }
        $arrayImg=array_merge($arrOldImage,$arrayImg);
      }else{
        $arrayImg=$request->old_list_image;
      }
      $imgUpdate = $infoPD->image;
      // kiem tra image
      if ($request->hasFile('image')) {
        $validator = Validator::make(
          $request->all(),
          [
            'image' => ['required', 'max:2048','mimes:png,jpg,svg'],
            
          ],
          [
            'image.required' => 'vui long chon anh san pham',
            'image.mimes' => 'dinh dang anh sai anh chap nhan jpg,svg,png',
            'image.max' => 'kich thuoc size qua lon'
          ]
        );
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        $imgUpdate = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('upload/images/product'), $imgUpdate);

      }
      // cap nhat du lieu vao bang product
      Product::where('id', $idProduct)->update(
        [
          'name' => $request->name,
          'slug' => CommonHelper::slugVietnamese($request->name),
          'description' => $request->description,
          'categories_id' => $request->categories_id,
          'summary' => $request->summary,
          'image' => $imgUpdate,
          'list_image' => empty($arrayImg) ? $infoPD->list_image : json_encode($arrayImg),
          'price' => $request->price,
          'is_sale' => $request->in_sale == 'on' ? '1' : '0',
          'quantity' => $request->quantity,
          'sale_price' => $request->sale_price,
          'status' => $request->status,
          'updated_at' => date('Y-m-d H:i:s')


        ]
      );
      // tien hanh update product_color
      $arrColorProduct = $request->color_id;
      if (!empty($arrColorProduct) && is_array($arrColorProduct)) {
        ProductColor::where('product_id', $idProduct)->delete();
        $dataUPdateColor = [];
        foreach ($arrColorProduct as $color) {
          $dataUPdateColor[] = [
            'product_id'=>$idProduct,
            'color_id' => $color,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ];
        }
        ;
        ProductColor::insert($dataUPdateColor);
      }
      $arrSizeProduct = $request->size_id;
      if (!empty($arrSizeProduct) && is_array($arrSizeProduct)) {
        ProductSize::where('product_id', $idProduct)->delete();
        $dataUPdateSize = [];
        foreach ($arrSizeProduct as $size) {
          $dataUPdateSize[] = [
            'product_id'=>$idProduct,
            'size_id' => $size,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ];
        }
        ;
        ProductSize::insert($dataUPdateSize);
      }
      $arrTagProduct = $request->tag_id;
      if (!empty($arrTagProduct) && is_array($arrTagProduct)) {
        ProductTag::where('product_id', $idProduct)->delete();
        $dataUPdateTag = [];
        foreach ($arrTagProduct as $tag) {
          $dataUPdateTag[] = [
            'product_id'=>$idProduct,
            'tag_id' => $tag,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ];
        }
        ;
        ProductTag::insert($dataUPdateTag);
      }
      return redirect()->route('admin.product')->with('update_success', 'update thanh cong');
    }

  }
}
