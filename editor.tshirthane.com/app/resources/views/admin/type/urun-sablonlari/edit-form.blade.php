
<?php 
$path = "admin.type.urun-sablonlari";
if(getisset("save-area")) {
    //dd($_GET);
    echo 
    
    db("urun_sablonlari")
        ->where("id",get("edit"))
        ->update([
            'areas' => get("areas")
        ]);
    
    exit();
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

{{col("col-12","Edit Form")}} 
@include("$path.script")
                <form action="{{url('admin-ajax/cover-upload')}}" class="hidden-upload" id="f{{$edit->id}}" enctype="multipart/form-data" method="post">
                                <input type="file" name="cover" id="c{{$edit->id}}" onchange="$('#f{{$edit->id}}').submit();" required />
                                <input type="hidden" name="id" value="{{$edit->id}}" />
                                
                                <input type="hidden" name="slug" value="{{$edit->slug}}" />
                                {{csrf_field()}}
                            </form>
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
                        if(getisset("edit")) {
                            if(is_array($j)) {
                                $array = $j;
                                dump($j);
                            }
                        }
                       
                        foreach($array AS $name => $value) {
                             ?>
                             <div class="col-md-12">
                                <div class="border p-10 mb-5 mt-5 rounded">
                                    {{$name}}
                                    
                                    
                                    <?php if(is_array($value)) {
                                        ?>
                                        <div class="row">
                                            
                                            <?php 
                                                foreach($value AS $name2 => $value2) {
                                                    ?>
                                                    <div class="col-md-6 {{$name}} {{$name}}{{$name2}}">
                                                        <div class="border p-10 mb-10 rounded ">
                                                            
                                                            <?php if(is_array($value2)) {
                                                                foreach($value2 AS $name3 => $value3) {
                                                                    ?>
                                                                    {{$name3}}
                                                                 <?php 
                                                                switch ($name3) {
                                                                    
                                                                    case 'currency':
                                                                        $selectName = $name. "[$name2][$name3]";
                                                                        $selectValue = @$j[$name][$name2][$name3];
                                                                         ?>
                                                                        @include("$path.currency")
                                                                         <?php 
                                                                        break;
                                                                    
                                                                    default:
                                                                            $defaultName = $name . "[$name2][$name3]";
                                                                            $defaultValue = @$j[$name][$name2][$name3];
                                                                            $defaultPlaceHolder = $value3;

                                                                        ?>
                                                                            @include("$path.default")
                                                                           
                                                                     <?php 
                                                                        break;
                                                                }
                                                            ?>
                                                                    
                                                                    <?php 
                                                                }
                                                                ?>
                                                             
                                                                <?php 
                                                            } else  { 
                                                                 ?>
                                                                 {{$name2}}
                                                                 <?php 
                                                                switch ($name2) {
                                                                    
                                                                    case 'currency':
                                                                        $selectName = $name . "[$name2]";
                                                                        $selectValue = @$j[$name][$name2];
                                                                         ?>
                                                                         @include("$path.currency")
                                                                         <?php 
                                                                        break;
                                                                    
                                                                    default:
                                                                        $defaultName = $name . "[$name2]";
                                                                        $defaultValue = @$j[$name][$name2];
                                                                        $defaultPlaceHolder = $value2;

                                                                     ?>
                                                                        @include("$path.default")
                        
                                                                     <?php 
                                                                        break;
                                                                }
                                                            ?>
                                                            
                                                           
                                                            <?php } ?>
                                                            <?php if($name=="variants") {
                                                                 ?>
                                                                 <div data-class="{{$name}}{{$name2}}" class="btn btn-danger variant-delete mt-5">Sil</div>
                                                                 <?php 

                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }
                                            ?>
                                            <?php if($name=="variants") { ?>
                                                <div class="col-12">
                                                    <div class="btn btn-primary"><i class="fa fa-plus"></i> Variant Ekle</div>
                                                </div>
                                                <?php 
                                            } ?>
                                        </div>
                                    <?php 
                                
                                    } else  { 
                                        switch ($name) {
                                            case 'currency':
                                                    $selectName = $name;
                                                    $selectValue = @$j[$name];
                                                 ?>
                                                 @include("$path.currency")
                                                 <?php 
                                                break;
                                            
                                            default:
                                             ?>
                                                <input type="text" name="{{$name}}" placeholder="{{$value}}" value="{{@$j[$name]}}" id="" class="form-control"> 

                                             <?php 
                                                break;
                                        }
                                    ?>
                                    <?php } ?>
                                </div>
                            </div>
                             <?php 
                        }
                        ?>
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
        
            <form action="{{url('admin-ajax/files-upload')}}" id="files{{$edit->id}}" class="dropzone d-none" id="dropzone" enctype="multipart/form-data" method="post">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                    
                                    </div>
                                    @if($edit->files!="") 
                                        @php
                                        $files = explode(",",$edit->files);
                                        @endphp
                                        @foreach(@$files AS $f)
                                        <?php $file_title = str_replace("storage/app/files/".$edit->slug . "/","",$f); ?>
                                        <div file="{{$f}}" class="dz-preview dz-file-preview dz-processing dz-error dz-complete">  
                                            <div class="dz-image"><img data-dz-thumbnail="" onerror='$(this).hide();' src="{{url($f)}}" width="100%"></div>  <div class="dz-details">    
                                            <div class="dz-filename"><span data-dz-name="">{{$file_title}}</span></div>  </div>  
                                            <div class="dz-success-mark">   
                                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">      
                                            <title>Check</title>      
                                            <defs></defs>      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">       
                                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>      </g>    </svg>  </div>  
                                            <div class="btn-group">
                                                <div  class="btn btn-default delete"><i class="fa fa-times"></i></div>								  
                                                <a href="{{url($f)}}" target="_blank" class="btn btn-default "><i class="fa fa-download"></i></a>								
                                                <?php if(strpos($f,".fbx")!==false) {
                                                        ?>
                                                        <a href="{{url("three-js?file=".$f)}}" target="_blank" class="btn btn-default " title="{{e2("3D Önizleme")}}"><i class="fa fa-box"></i></a>
                                                        <?php 
                                                } ?>  
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    <div class="dz-message" data-dz-message><span>{{__('You can upload files of the content by dropping or clicking here')}}</span></div>
                                    <input type="hidden" name="id" value="{{$edit->id}}" />
                                <input type="hidden" name="slug" value="{{$edit->slug}}" />
                                {{csrf_field()}}
                            </form>
                            <script type="text/javascript">
                            $(function(){
                                
                                $(".dz-preview .delete").on("click",function(){
                                    var bu = $(this).parent().parent();
                                    bu.fadeTo(0.5);
                                    $.post("{{url('admin-ajax/delete-file')}}",{
                                        file:bu.attr("file"),
                                        slug : "{{$edit->slug}}",
                                        id : "{{$edit->id}}",
                                        _token : "{{csrf_token()}}"
                                    },function(d){
                                        bu.fadeOut();
                                    });
                                    $(".dz-message").html("")
                                    
                                }).css("cursor","pointer");
                                
                            });
                            </script>
            
                
                {{_col()}} 