
<form action="?ajax=other-files-upload" id="files{{$edit->id}}" class="dropzone mb-10" id="dropzone" enctype="multipart/form-data" method="post">
        <div class="fallback">
            <input name="file" type="file" multiple />
            
            </div>
            @if($edit->other_files!="") 
                @php
                $files = explode(",",$edit->other_files);
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
            <div class="dz-message" data-dz-message><span>Ürüne ait diğer görselleri buraya yükleyiniz.</span></div>
            <input type="hidden" name="id" value="{{$edit->id}}" />
        <input type="hidden" name="slug" value="{{$edit->slug}}" />
        {{csrf_field()}}
    </form>
    <script type="text/javascript">
    $(function(){
        
        $(".dz-preview .delete").on("click",function(){
            var bu = $(this).parent().parent();
            bu.fadeTo(0.5);
            $.post("{{url('admin-ajax/urun-sablonlari-delete-file')}}",{
                file:bu.attr("file"),
                slug : "{{$edit->title}}",
                id : "{{$edit->id}}",
                _token : "{{csrf_token()}}"
            },function(d){
                bu.fadeOut();
            });
            $(".dz-message").html("")
            
        }).css("cursor","pointer");
        
    });
    </script>