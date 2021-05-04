<x-dynamic-component :component="$app->componentName">

@if($stub == 'create')
    <form action="{{ route($app->module.'.store') }}" id="post_form" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); addTextarea();">
@else
    <form action="{{ route($app->module.'.update', $obj->id) }}" id="post_form" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); addTextarea();">
@endif
    <!-----begin second header------->
    <div class="col-lg-12 pt-3 d-flex justify-content-end">
        <div class="col-8">
            <div class="d-flex justify-content-around align-items-center bg-white rounded-lg shadow-sm p-3">
                <label class="checkbox">
                    <input type="checkbox" name="status" @if($stub == 'update'){{$obj->status == '1' ? 'checked' : ''}}@endif/>
                    <span class="mr-2"></span>
                        Active
                </label>
                <button type="submit" name="publish" value="save_as_draft" class="btn">Save As Draft</button>
                <button type="submit" name="publish" value="preview" class="btn btn-outline-primary">Preview</button>
                <div class="ml-3">
                    <div class="input-group date">
                        <input type="text" class="form-control bg-white" readonly="readonly" name="published_at" value="@if($stub == 'update'){{$obj ? $obj->published_at : ''}}@endif" placeholder="Schedule" id="kt_datetimepicker_2" onclick="this.value=''"/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="far fa-calendar-check"></i>
                            </span>
                        </div>
                    </div>
                </div>
                @if($stub=='update')
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $obj->id }}">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary ml-3" name="publish" value="now">Publish Now</button>
            </div>
        </div>
    </div>
    <!-----end second header--------->

    <!------------begin::Content------------->
    <div class="mt-5">
        <div class="row container m-0 p-0 my-5">
            <div class="col-xl-9 bg-white p-5 rounded-lg">
                <input type="text" id="title" onkeyup="createSlug()"
                    class="form-control p-0 display-3" style="border: none; background: transparent;"
                    name="title" value="@if($stub == 'update'){{$obj ? $obj->title : 'Title'}}@else{{ 'Type your title here' }}@endif"/>
                <div class="d-flex align-items-center justify-content-left">
                    <label class="m-0 text-muted">Slug:</label>
                    <input type="text" id="slug" style="border: none; background: transparent;"
                        class="form-control p-0 d-inline ml-3"
                        name="slug" value="@if($stub == 'update'){{$obj ? $obj->slug : ''}}@else{{ 'type-your-title-here' }}@endif"/>
                </div>
                <textarea type="text"
                    class="form-control border h-auto px-3 py-3 mb-3 font-size-h6"
                    name="excerpt" placeholder="Give a Description" style="min-height: 4rem;"/>@if($stub == 'update'){{$obj ? $obj->excerpt : ''}}@endif</textarea>

                <!-- Content -->
                <textarea name="content" hidden id="post_textarea"></textarea>
                <!-- Create toolbar container -->
                <div id="toolbar">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                            <option value="4"></option>
                            <option value="5"></option>
                            <option value="6"></option>
                            <option value="false"></option>
                        </select>
                        
                        <select class="ql-size">
                            <option value="small"></option>
                            <option selected></option>
                            <option value="large"></option>
                            <option value="huge"></option>
                        </select>

                    </span>

                    <!-- Add a bold button -->
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>

                    <span class="ql-formats">
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                    </span>

                    <span class="ql-formats">
                        <select class="ql-align"></select>
                    </span>

                    <span class="ql-formats">
                        <button class="ql-image"></button>
                        <button class="ql-link"></button>
                        <button class="ql-video"></button>
                    </span> 

                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>

                    <span class="ql-formats">
                        <button class="ql-script" value="sub"></button>
                        <button class="ql-script" value="super"></button>
                    </span>

                    <span class="ql-formats">
                        <button class="ql-blockquote"></button>
                        <button class="ql-code-block"></button>
                    </span>

                    <span class="ql-formats">
                        <button class="ql-clean"></button>
                    </span>  

                    <span class="ql-formats">
                        <button class="ql-html" onclick="addHtmlContent('new')">Source</button>
                    </span> 

                    <!-- <span class="ql-formats">
                        <button id="insert-table">Insert Table</button>
                        <button id="insert-row-above">Insert Row Above</button>
                        <button id="insert-row-below">Insert Row Below</button>
                        <button id="insert-column-left">Insert Column Left</button>
                        <button id="insert-column-right">Insert Column Right</button>
                        <button id="delete-row">Delete Row</button>
                        <button id="delete-column">Delete Column</button>
                        <button id="delete-table">Delete Table</button>
                    </span>                 -->

                    <div class="dropdown ql-formats">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Table
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 15rem;">
                            <li><a class="dropdown-item" href="#"><button id="insert-table">Insert Table</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="insert-row-above">Insert Row Above</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="insert-row-below">Insert Row Below</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="insert-column-left">Insert Column Left</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="insert-column-right">Insert Column Right</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="delete-row">Delete Row</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="delete-column">Delete Column</button></a></li>
                            <li><a class="dropdown-item" href="#"><button id="delete-table">Delete Table</button></a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div id="post_editor" style="min-height: 57rem;">
                        {!! $obj->content !!}
                    </div>
                </div>

                <!-- HTML Content Modal -->
                <div class="modal fade" id="html_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 95%; max-height: 90vh;">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Source</h5>
                            <button type="button" class="close text-dark btn btn-lg" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group bg-light border">
                                <label for="formGroupExampleInput " class="px-4 pt-4 pb-2">HTML Editor</label>
                                <div class="">
                                    <div id="post_content" style="width: 100%; height:40rem;"></div>
                                        <textarea id="post_content_editor" class="form-control border d-none" rows="5">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="addHtmlContent('copy');">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column -->
            <div class="col-xl-3 mt-3 mt-lg-0">
                <div class="bg-white p-5 rounded-lg">

                    <!-- Featured -->
                    <div class="p-3 bg-white my-3 rounded-lg shadow-sm">
                        <label class="checkbox">
                            <input type="checkbox" name="featured" @if($stub == 'update'){{$obj->featured == 'on' ? 'checked' : ''}}@endif/>
                            <span class="mr-2"></span>
                                Featured Post
                        </label>
                    </div> 
                    <!-- End Featured -->
    
                    <!-- Public or Priovate -->
                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                        <div class="card border rounded-lg mt-5">
                            <div class="card-header" id="headingOne6">
                                <div class="card-title" data-toggle="collapse" data-target="#visibility">
                                    <i class="fas fa-eye"></i> Visilibity
                                </div>
                            </div>
                            <div id="visibility" class="collapse show" data-parent="#accordionExample6">
                                <div class="card-body">
                                    <!--begin::Form Group-->
                                     <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visibility" id="public" value="public" onclick="showGroup()" @if($stub == 'update'){{$obj->visibility == 'public' ? 'checked' : ''}}@else {{ 'checked' }}@endif>
                                            <label class="form-check-label" for="inlineRadio1">Public</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visibility" id="private" value="private" onclick="showGroup()" @if($stub == 'update'){{$obj->visibility == 'private' ? 'checked' : ''}}@endif>
                                            <label class="form-check-label" for="inlineRadio2">Private</label>
                                        </div>
                                     </div>
                                    <!--end::Form Group-->
                                    <textarea name="group" id="group" class="form-control bg-light mt-3" cols="30" rows="3" style="resize: none; display:@if($stub == 'update'){{$obj->visibility == 'private' ? 'block' : 'none'}}@else {{ 'none' }}@endif;" placeholder="Type in Comma Separated Group Names">@if($stub == 'update'){{$obj->group ? $obj->group : ''}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Public or Private -->
                    

                    <div class="p-7 rounded border my-3 bg-white">
                        <h3 class="d-flex align-items-center mb-5">Featured Image</h3>
                        
                            <div id="featured_image" class="d-none @if($obj->image) {{ 'd-block' }} @else {{ 'd-none' }} @endif">
                                <img src="{{ url('/').'/storage/'.$obj->image }}" class="img-fluid">
                                <button type="button" class="btn btn-danger mt-3" id="delete_image" onclick="deleteImage()">Delete</button>
                            </div>
                
                            <div id="dropzone" class="d-none @if($obj->image) {{ 'd-none' }} @else {{ 'd-block' }} @endif">
                                <div class="card card-custom m-0 gutter-b">
                                    <div class="dropzone dropzone-default bg-light" id="kt_dropzone_1">
                                        <div class="dropzone-msg dz-message needsclick">
                                            <img src="{{ asset('img/upload.png') }}" class="img-fluid w-50">
                                            <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                        </div>
                                    </div>
                                    <input type="hidden" id="dropzone_url" value="{{ url('/') }}/admin/dropzone">
                                    <input type="hidden" class="_token" name="_token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        
                        <input type="hidden" id="image_url" name="image" value="@if($stub == 'update'){{$obj ? $obj->image : ''}}@endif">
                    </div>

                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                        <div class="card border rounded-lg mt-5">
                            <div class="card-header" id="headingOne6">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                    <i class="fas fa-cookie"></i> Meta Data
                                </div>
                            </div>
                            <div id="collapseOne1" class="collapse show" data-parent="#accordionExample6">
                                <div class="card-body">
                                    <!--begin::Form Group-->
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control h-auto bg-light border mb-2 p-3 rounded-md font-size-h6"
                                            name="meta_title" placeholder="Title" value="@if($stub == 'update'){{$obj ? $obj->meta_title : ''}}@endif"/>
                                        <input type="text"
                                            class="form-control h-auto border bg-light p-3 rounded-md font-size-h6"
                                            name="meta_description" placeholder="Description" value="@if($stub == 'update'){{$obj ? $obj->meta_description : ''}}@endif"/>
                                    </div>
                                    <!--end::Form Group-->
                                </div>
                            </div>
                        </div>
                        <div class="card border rounded-lg">
                            <div class="card-header" id="headingOne6">
                                <div class="card-title " data-toggle="collapse" data-target="#collapseOne2">
                                    <i class="fas fa-stream"></i> Categories
                                </div>
                            </div>
                            <div id="collapseOne2" class="collapse show" data-parent="#accordionExample6">
                                <div class="card-body">
                                    <select class="form-control select2" id="kt_select2_1" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" selected ="@if($stub == 'update') $obj->category_id == $category->id ? {{ 'selected' }} : '' @endif">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card border rounded-lg">
                            <div class="card-header" id="headingOne6">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne3">
                                    <i class="fas fa-tags"></i> Tags
                                </div>
                            </div>
                            <div id="collapseOne3" class="collapse show" data-parent="#accordionExample6">
                                <div class="card-body">
                                    <!------begin Tags------>
                                    <select class="form-control select2" style="min-height: 2.5rem;" id="kt_select2_11" name="tag_ids[]" multiple="multiple" placeholder="Add a Tag">

                                        @php
                                            $tag_ids = [];
                                            foreach($obj->tags as $tag){
                                                array_push($tag_ids, $tag->id);
                                            }
                                        @endphp

                                        @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}" @if($stub == "update") @if(in_array($tag->id, $tag_ids)) {{ "selected" }} @endif @endif>{{ $tag->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                    <!------end Tags-------->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- end::Right Column -->
        </div>
    </div>
    <!--end::Content-->

</form>

</x-dynamic-component>
