<div class="content">
	<div class="block">
		<div class="block-header block-header-default">
			<h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}} {{__('Contents')}}</h3>
			<div class="block-options">
				<div class="block-options-item"> <a
						href="{{ url('admin-ajax/content-type-blank-delete?type='. $c->title) }}"
						teyit="{{__('Tüm boş '.$c->title.'  '._('') )}}" title="{{_('Boş Olan  İçeriklerini Sil')}}"
						class="btn btn-danger"><i class="fa fa-times"></i> </a> <a
						href="{{ url('admin-ajax/content-type-add?type='. $c->title) }}" class="btn btn-success"
						title="Yeni {{$c->title}} {{_('İçeriği Oluştur')}}"><i class="fa fa-plus"></i> </a> </div>
			</div>
		</div>
		<div class="block-content">
			<div class="js-gallery "> @include("admin.inc.table-search") <div class="table-responsive">
					<table class="table table-striped table-hover table-bordered table-vcenter">
						<thead>
							<tr>
								<th class="text-center" style="width: 50px;">{{__("Cover")}}</th>
								<th>{{__("Title")}}</th>
								<th>{{__("URL")}}</th>
								<th>{{__("Category")}}</th>
								<th class="d-none" style="width: 15%;">{{__("Type")}}</th>
								<th>{{__("Status")}}</th>
								<th>{{__("Order")}}</th>
								<th class="text-center" style="width: 100px;">{{__("Transactions")}}</th>
							</tr>
						</thead>
						<tbody> @foreach($alt AS $a) <tr class="">
								<th class="text-center cover" scope="row"> @if($a->cover!='') <a
										href="{{url('cache/large/'.$a->cover)}}"
										class="img-link img-link-zoom-in img-thumb img-lightbox" target="_blank"> <img
											src="{{url('cache/small/'.$a->cover)}}" width="92" alt="" /> </a>
									<hr /> @endif <div class="btn-group"> <button type="button"
											class="btn  btn-secondary btn-sm"
											onclick="$('#c{{$a->id}}').trigger('click');"
											title="{{__('Upload')}}"><i class="fa fa-upload"></i></button>
										@if($a->cover!='') <a
											teyit="{{__('Are you sure you want to remove the image?')}}"
											title="{{__('Remove image')}}"
											href="{{url('admin-ajax/cover-delete?id='.$a->id)}}"
											class="btn btn-secondary btn-sm "><i class="fa fa-times"></i></a> <a
											title="{{__('Download')}}" href="{{url('cache/download/'.$a->cover)}}"
											class="btn btn-secondary btn-sm"><i class="fa fa-download"></i></a> @endif
									</div>
									<form action="{{url('admin-ajax/cover-upload')}}" id="f{{$a->id}}"
										class="hidden-upload" enctype="multipart/form-data" method="post"> <input
											type="file" name="cover" id="c{{$a->id}}"
											onchange="$('#f{{$a->id}}').submit();" required /> <input type="hidden"
											name="id" value="{{$a->id}}" /> <input type="hidden" name="slug"
											value="{{$a->slug}}" /> {{csrf_field()}} </form>
								</th>
								<td><input type="text" name="title" value="{{$a->title}}" table="contents"
										id="{{$a->id}}" class="title{{$a->id}} form-control edit" />
									<small>{{$a->breadcrumb}}</small> </td>
								<td class="">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="btn btn-default"
												onclick="$.get('{{url('admin-ajax/slug?title='.$a->breadcrumb)}}'+$('.title{{$a->id}}').val(),function(d){										$('.slug{{$a->id}}').val(d).blur();									})">
												<i class="si si-refresh"></i></div>
										</div> <input type="text" name="slug" value="{{$a->slug}}" table="contents"
											id="{{$a->id}}" class="slug{{$a->id}} form-control edit" />
									</div>
								</td>
								<td><input type="text" name="kid" value="{{$a->kid}}" table="contents" id="{{$a->id}}"
										class="form-control edit" /></td>
								<td class="d-none"> <select name="type" id="{{$a->id}}"
										class="select2 form-control edit" table="contents"> @foreach($types AS $t)
										<option value="{{$t->title}}" @if($t->title==$a->type) selected
											@endif>{{$t->title}}</option> @endforeach </select> </td>
								<td> <select name="y" id="{{$a->id}}" class=" form-control edit" table="contents">
										<option value="0" @if($a->y==0) selected @endif>{{__("Disabled")}}</option>
										<option value="1" @if($a->y==1) selected @endif>{{__("Enabled")}}</option>
									</select> </td>
								<td><input type="number" name="s" value="{{$a->s}}" table="contents" id="{{$a->id}}"
										class="form-control edit" /></td>
								<td class="text-center">
									<div class="btn-group"> <a href="{{ url('admin/contents/'. $a->slug) }}"
											class="btn btn-secondary js-tooltip-enabled" data-toggle="tooltip" title=""
											data-original-title="Edit"> <i class="fa fa-edit"></i> </a> <a
											href="{{ url('admin/contents/'. $a->slug .'/delete') }}"
											teyit="{{$a->title}} {{__('Are you sure you want to delete its content?')}}"
											title="{{$a->title}} {{__('To be deleted!')}}"
											class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip"
											title="" data-original-title="Delete"> <i class="fa fa-times"></i> </a>
									</div>
								</td>
							</tr> @endforeach </tbody>
					</table> {{$alt->fragment('alt')->links() }}
				</div>
			</div>
		</div>
	</div>
</div>