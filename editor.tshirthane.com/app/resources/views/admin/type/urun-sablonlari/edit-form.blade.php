
<?php 
$path = "admin.type.urun-sablonlari";
if(getisset("save-area")) {
    //dd($_GET);
   // echo 
    
    db("urun_sablonlari")
        ->where("id",get("edit"))
        ->update([
            'areas' => get("areas")
        ]);
    
 //   exit();
} 

?>
<style>
    #imageContainer {
        position:relative;
    }
    <?php if($edit->areas!="")  { 
        $area = j($edit->areas);
       // dd($area);
      ?>
     .area {
         position:absolute;
         border:dashed 3px red;
         top: {{$area['y']}}px;
         left: {{$area['x']}}px;
         width:{{$area['w']}}px;
         height:{{$area['h']}}px;
     } 
     <?php } ?>
</style>

{{col("col-12","Ürünü Düzenle")}} 
@include("$path.script")
                <form action="{{url('admin-ajax/cover-upload')}}" class="hidden-upload"  id="f{{$edit->id}}" enctype="multipart/form-data" method="post">
                    <input type="file" name="cover" id="c{{$edit->id}}" onchange="$('#f{{$edit->id}}').submit();" required />
                    <input type="hidden" name="id" value="{{$edit->id}}" />
                    
                    <input type="hidden" name="slug" value="{{$edit->slug}}" />
                    {{csrf_field()}}
                </form>
               @include("$path.other-files")
            <form action="?edit={{get("edit")}}&update" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <?php if($edit->files!="") {
                             ?>
                             <div id="imageContainer">
                                <img src="{{url($edit->files)}}" id="imageAreas" alt="">
                                <div class="area"></div>
                             </div>
                             <?php 
                        } ?> <br>
                        Mockup Görseli
                        <input type="hidden" name="old_file" value="{{$edit->files}}">

                        <input type="file" name="file" id="" class="form-control">
                        {{__('Ürün Başlığı')}}
                        <input type="hidden" name="id" value="{{$edit->id}}" />
                        
                        <input type="hidden" name="oldslug" value="{{$edit->slug}}" />
                        <input type="text" name="title" id="title" value="{{$edit->title}}" class="form-control" />
                        <div class="d-none">
                            {{__('ID')}} <div class="btn btn-default" onclick="$.get('{{url('admin-ajax/slug?title='.$edit->breadcrumb)}}'+$('#title').val(),function(d){
                                $('#slug').val(d)
                            })"><i class="si si-refresh"></i></div>
                            
                    
                            <input type="text" name="slug" id="slug" value="{{$edit->slug}}" class="form-control" />
                            {{e2("Parent")}}
                            <input type="text" name="kid" class="form-control" value="{{$edit->kid}}" />
                            {{__('Content Type')}}
                            <select name="type" id="{{$edit->id}}" class="form-control edit" table="contents" >
                                <option value="">Tip Seçiniz</option>
                            @foreach(@$types AS $t)
                                <option value="{{$t->title}}" @if($t->title==$edit->type) selected @endif>{{$t->title}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="row">
                        <?php 
                        
                        $array = productArray();
                      //  dump($array);
                        if(getisset("edit")) {
                            if(is_array($j)) {
                                $array = $j;
                               // dump($j);
                            }
                        }
                       
                        
                             ?>
                             @include("$path.edit-form-content")
                            
                        </div>
                        {{__('Content')}}
                        <textarea class="" id="editor" name="html">{{$edit->html}}</textarea>
                        
                    </div>
                    <div class="col-md-3 text-center d-none">
                    @if($edit->cover!='')
                        <div class="js-gallery">
                            <a href="{{url('cache/large/'.$edit->cover)}}" class="img-link img-link-zoom-in img-thumb img-lightbox"  target="_blank" >
                                <img src="{{url('cache/small/'.$edit->cover)}}" alt="" />
                            </a>
                        </div>
                            <hr />
                            @else 
                                    <i class="fa fa-image" style="    display: block;
            font-size: 150px;
            color: #f3f3f3;"></i>
                            @endif
                            <div class="btn-group">
                            <button type="button" class="btn  btn-secondary btn-sm" onclick="$('#c{{$edit->id}}').trigger('click');" title="{{__('Resim Yükle')}}"><i class="fa fa-upload"></i> {{__('Kapak Resmi Yükle')}}</button>
                            @if($edit->cover!='')
                            <a teyit="{{__('Resmi kaldırmak istediğinizden emin misiniz')}}" title="{{__('Resmi kaldır')}}" href="{{url('admin-ajax/cover-delete?id='.$edit->id)}}" class="btn btn-secondary btn-sm "><i class="fa fa-times"></i></a>
                            <a title="{{__('Resmi indir')}}" href="{{url('cache/download/'.$edit->cover)}}" class="btn btn-secondary btn-sm"><i class="fa fa-download"></i></a>
                            @endif
                            </div>
                            
                    </div>
                </div>
                
                
                <hr />
                <div class="">
                    <button type="submit" class="save-button btn btn-primary">{{__('Güncelle')}}</button>
                    <a href="?edit={{get("edit")}}&test"  class="ajax_modal btn btn-danger">Test Olarak Gönder</a>
                    <div class="test-sonuc"></div>
                </div>
            </form>
        
            
            
                
                {{_col()}} 