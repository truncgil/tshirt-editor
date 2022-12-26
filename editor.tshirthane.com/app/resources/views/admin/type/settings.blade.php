<div class="content">
    <div class="row">
        <?php 
        $table_name = str_slug($c->title,'_');
        if(getisset("edit"))  { 
            $edit = db($table_name)->where("id",get("edit"))->first();
          ?>
                @include("admin.type.inc.edit-form")
         <?php } ?>
    </div>

<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i>Setting List</h3>
            <div class="block-options">
                <div class="block-options-item"> 
                    <a href="{{ url('admin-ajax/content-type-blank-delete?type='. $c->title) }}" teyit="{{__('Tüm boş '.$c->title.'  '._('') )}}" title="{{_('Boş Olan  İçeriklerini Sil')}}" class="btn btn-danger"><i class="fa fa-times"></i> </a>
                    <a href="{{ url('admin-ajax/content-type-add?table=settings&type='. $c->title) }}" class="btn btn-success" title="Yeni {{$c->title}} {{_('Create Settings')}}"><i class="fa fa-plus"></i> </a>
                </div>
            </div>
        </div>
		

        <div class="block-content">
			<div class="js-gallery ">
			@include("admin.inc.table-search")
			<div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>{{__("Setting Name")}}</th>
						
                        <th class="text-center" style="width: 100px;">{{__("Transaction")}}</th>
                    </tr>
                </thead>
                <tbody>
				<?php $alt = db("settings")->orderBy("id","DESC")->simplePaginate(20); ?>
				@foreach($alt AS $a)
					<tr class="">
                       
                        <td><input type="text" name="title" value="{{$a->title}}" table="settings" id="{{$a->id}}" class="title{{$a->id}} form-control edit" />
						</td>
						
						
					  <td class="text-center">
                            <div class="btn-group">
                                <a href="?edit={{$a->id}}" class="btn btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?delete={{$a->id}}" teyit="{{$a->title}} {{__('içeriğini silmek istediğinizden emin misiniz?')}}" title="{{$a->title}} {{__('Silinecek!')}}" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
				@endforeach
				
                                     
                                    </tbody>
            </table>
			{{$alt->fragment('alt')->links() }}
			</div>
			</div>
        </div>
		
    </div>
</div>