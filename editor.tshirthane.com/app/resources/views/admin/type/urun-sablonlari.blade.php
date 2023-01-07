<div class="content">
    <div class="row">
            <div class="col-12">
                <?php 
                    $table_name = str_slug($c->title,'_');
                    if(getisset("edit"))  { 

                        if(getisset("update")) {
                            $p = $_POST;
                        //  dump($p);
                            $json = $p;
                            $file = post("old_file");
                            $json['longDescription'] = $json['html'];
                            $json['shortDescription'] = substr($json['html'],0,150);
                            unset($json['html']);
                            unset($json['_token']);
                            unset($json['old_file']);
                            unset($json['oldslug']);
                            unset($json['id']);
                            unset($json['kid']);
                            unset($json['type']);
                            
                            //dump($json);
                            if($_FILES['file']['name']!="") {
                                $file = upload("file","mockup/");
                            //   echo $file;
                            }
                            $file = str_replace("//","/",$file);
                            $json['images'][0]['imageUrl'] = env('APP_URL') . $file;
                        //    dump($json);
                            db($table_name)->where("id",get("edit"))->update([
                                "title" => $p['title'],
                                "html" => $p['html'],
                                "files" => $file,
                                "json" => json_encode_tr($json)
                            ]);
                        //  dump($json);
                            bilgi("Güncelleme yapıldı");
                            //exit();
                        }
                        
                        

                        $edit = db($table_name)->where("id",get("edit"))->first();

                        if($edit->json!="") {
                            $j = j($edit->json);
                        //   dump($j);

                            if(getisset("test")) {
                                $data = $j;
                                //dump($data);
                                sendProduct($data);
                                 ?>
                                 <a href="https://www.tshirthane.com/template/common/api_docs/web_servis_dokuman_v2.0.4.pdf" class="btn btn-success">API Dokümantasyonu</a>

                                 <?php 
                                exit();
                            }
                        }

                    ?>
            </div>
            
            @include("admin.type.urun-sablonlari.edit-form")
         <?php } ?>
    </div>
    </div>

<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}} {{__('Contents')}}</h3>
            <div class="block-options">
                <div class="block-options-item"> 
                    <a href="{{ url('admin-ajax/content-type-blank-delete?type='. $c->title) }}" teyit="{{__('Tüm boş '.$c->title.'  '._('') )}}" title="{{_('Boş Olan  İçeriklerini Sil')}}" class="btn btn-danger"><i class="fa fa-times"></i> </a>
                    <a href="{{ url('admin-ajax/content-type-add?table='.$table_name.'&type='. $c->title) }}" class="btn btn-success" title="Yeni {{$c->title}} {{_('İçeriği Oluştur')}}"><i class="fa fa-plus"></i> </a>
                </div>
            </div>
        </div>
		

        <div class="block-content">
			<div class="js-gallery ">
			@include("admin.inc.table-search")
            <?php 
            if(getisset("delete")) {
                    db($table_name)->where("id",get("delete"))->delete();
                    bilgi(get("id") . " ürün şablonu silinmiştir.");
                }  
            ?>
            <div class="row">
                <?php 
                  
                $alt = db($table_name)->orderBy("id","DESC")->simplePaginate(20); ?>
				@foreach($alt AS $a)
                <?php if($a->title=="") $a->title="Adsız şablon"; ?>
                 {{col("col-xl-4 col-md-6",$a->title)}} 
                    <div style="width:250px;height:250px;">
                        <img src="{{picture2($a->files,256,0)}}" style=""  alt="">
                    </div>
                    <div class="btn-group">
                        <a href="?edit={{$a->id}}" class="btn btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="?delete={{$a->id}}" teyit="{{$a->title}} {{__('içeriğini silmek istediğinizden emin misiniz?')}}" title="{{$a->title}} {{__('Silinecek!')}}" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                 {{_col()}}
                 @endforeach
            </div>
			
			{{$alt->fragment('alt')->links() }}
		
			</div>
        </div>
		
    </div>
</div>