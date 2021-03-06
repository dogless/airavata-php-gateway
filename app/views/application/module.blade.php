@extends('layout.basic')

@section('page-header')
@parent
{{ HTML::style('css/style.css') }}
@stop

@section('content')

<div class="container">
    <div class="col-md-offset-2 col-md-8">

        <button class="btn btn-default create-app-module" data-toggle="modal" data-target="#new-app-module-block">Create
            a new Application Module
        </button>

        @if( count( $modules) )
        @if( Session::has("message"))
        <div class="row">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                {{ Session::get("message") }}
            </div>
        </div>
        {{ Session::forget("message") }}
        @endif
        <div class="row">
            <div class="col-md-6">
                <h3>Existing Modules :</h3>
            </div>
            <div class="col-md-6" style="margin-top:3.5%">
                <input type="text" class="col-md-12 filterinput" placeholder="Search by Module Name"/>
            </div>
        </div>
        <div class="panel-group" id="accordion">
            @foreach( $modules as $index => $module )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-{{$index}}">
                            {{ $module->appModuleName }}
                        </a>

                        <div class="pull-right col-md-2 module-options fade">
                            <span class="glyphicon glyphicon-pencil edit-app-module" style="cursor:pointer;"
                                  data-toggle="modal" data-target="#edit-app-module-block"
                                  data-module-data="{{ htmlentities(json_encode( $module) ) }}"></span>
                            <span class="glyphicon glyphicon-trash delete-app-module" style="cursor:pointer;"
                                  data-toggle="modal" data-target="#delete-app-module-block"
                                  data-module-data="{{ htmlentities(json_encode( $module) ) }}"></span>
                        </div>
                    </h4>
                </div>
                <div id="collapse-{{$index}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {{ $module->appModuleDescription }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif


        <div class="modal fade" id="new-app-module-block" tabindex="-1" role="dialog" aria-labelledby="add-modal"
             aria-hidden="true">
            <div class="modal-dialog">

                <form action="{{URL::to('/')}}/app/module-create" method="POST">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-center">Create a new Application Module</h3>
                        </div>
                        <div class="modal-body">
                            @include('partials/module-block')
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Save"/>
                                <input type="reset" class="reset-create-form btn btn-success" value="Reset"/>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>

        <div class="modal fade" id="edit-app-module-block" tabindex="-1" role="dialog" aria-labelledby="add-modal"
             aria-hidden="true">
            <div class="modal-dialog">

                <form action="{{URL::to('/')}}/app/module-edit" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-center">Edit Application Module</h3>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control edit-moduleid" name="appModuleId"/>
                            @include('partials/module-block')
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update"/>
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"/>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>

        <div class="modal fade" id="delete-app-module-block" tabindex="-1" role="dialog" aria-labelledby="add-modal"
             aria-hidden="true">
            <div class="modal-dialog">

                <form action="{{URL::to('/')}}/app/module-delete" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="text-center">Delete Confirmation Application Module</h3>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control delete-moduleid" name="appModuleId"/>

                            Do you really want to delete the Application Module - <span
                                class="delete-module-name"></span>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"/>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>

        @stop

        @section('scripts')
        @parent
        <script type="text/javascript">

            $(".panel-title").hover(
                function () {
                    $(this).find(".module-options").addClass("in");
                },
                function () {
                    $(this).find(".module-options").removeClass("in");
                }
            );

            $('.filterinput').keyup(function () {
                var a = $(this).val();
                if (a.length > 0) {
                    children = ($("#accordion").children());

                    var containing = children.filter(function () {
                        var regex = new RegExp('\\b' + a, 'i');
                        return regex.test($('a', this).text());
                    }).slideDown();
                    children.not(containing).slideUp();
                } else {
                    children.slideDown();
                }
                return false;
            });

            $(".create-app-module").click(function () {
                //reset form to clear it out if it got filled by edit modules
                $(".reset-create-form").click();
            })

            $(".edit-app-module").click(function () {
                var moduleData = $(this).data("module-data");
                console.log(moduleData);
                $(".edit-name").val(moduleData.appModuleName);
                $(".edit-desc").val(moduleData.appModuleDescription);
                $(".edit-version").val(moduleData.appModuleVersion);
                $(".edit-moduleid").val(moduleData.appModuleId)
            });

            $(".delete-app-module").click(function () {
                var moduleData = $(this).data("module-data");
                $(".delete-module-name").html(moduleData.appModuleName);
                $(".delete-moduleid").val(moduleData.appModuleId)
            });
        </script>

        @stop