<!DOCTYPE html>
<html>
    <head>
        <title>Todo</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>



    </head>
    <body>
        <div class="container" id="todos">
            <div class="row mar-top-20">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">To-do</div>
                        <div class="panel-body">
                            <div class="form">
                             <validator name="validation">
                                <form name="myForm" novalidate >
                                    <input type="hidden" name="_token" v-model="task._token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="control-label" >Title<sup v-show="$validation.title.required">*</sup></label>
                                        <div>
                                            <input class="form-control" name="title" type="text" v-model="task.title" v-validate:title="['required']"/>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" >Description</label>
                                        <div>
                                            <input class="form-control" name="description" type="text" v-model="task.description" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" >Due Date</label>
                                        <div>
                                            <div  class='input-group date' id='datetimepicker1'>
                                                <input name="due_date" v-model="task.due_date" type='text' class="form-control" />
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <button class="btn btn-primary" type="button" v-on:click="addNew(task)" v-if="$validation.valid" >Add New</button>
                                        </div>
                                    </div>
                                </form>
                                </validator>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Tasks
                        <span class="pull-right">@{{ time }}</span>
                        </div>
                        <div class="panel-body">

                            <ul class="list-group" v-if="listdue">
                                <template v-for="task in tasks">
                                <li class="list-group-item" v-if="!task.status">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <input value="1" v-model="task.status" v-on:change="mark(task)" type="checkbox" class="toggle">
                                        </div>
                                        <div class="col-md-7">
                                            @{{ task.title }}
                                        </div>
                                        <div class="col-md-3" v-bind:class="{'due': task.is_due}">
                                            @{{ task.due_date }}
                                        </div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="_token" v-model="task._token" value="{{ csrf_token() }}">
                                            <a href="javascript:void(0)"  v-on:click="remove(task)"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a>
                                        </div>

                                    </div>
                                </li>
                                </template>
                            </ul>


                            <ul class="list-group" v-if="!listdue">
                                <template v-for="task in tasks">
                                <li class="list-group-item" v-if="task.status">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <input value="1" v-model="task.status" v-on:change="mark(task)" type="checkbox" class="toggle">
                                        </div>
                                        <div class="col-md-7">
                                            @{{ task.title }}
                                        </div>
                                        <div class="col-md-3">
                                            @{{ task.due_date }}
                                        </div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="_token" v-model="task._token" value="{{ csrf_token() }}">
                                            <a href="javascript:void(0)"  v-on:click="remove(task)"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a>
                                        </div>

                                    </div>
                                </li>
                                </template>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default" v-on:click="showdue()">Due</button>
                            <button class="btn btn-default" v-on:click="showcomplete()">Completed</button>
                        </div>
                </div>
            </div>
        </div>
        </div>

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vue-resource.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vue-validator.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/function.js') }}"></script>
    </body>
</html>
