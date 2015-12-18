$(document).ready(function(){
    var vue = new Vue({
        el: '#todos',
      
        data: {
            tasks:[
                {
                    title: '',
                    description: '',
                    due_date: '',
                    status: '',
                    is_due: true
                },

            ],
            task:{
                title: '',
                description: '',
                due_date: moment().format('YYYY-MM-DD hh:mm:ss'),
                status: '',
 				is_due:true
            },
            time: moment(),
            listdue: true

        },
        methods: {
            list: function () {
                var resource = this.$resource('tasks/');

                // get item
                resource.get({}, function (items, status, request) {
                    if(items.status == 'success')
                        this.$set('tasks', items.data)
                });
            },

            addNew: function(task){
                var resource = this.$resource('tasks/store');

                resource.save({},task, function (item, status, request) {
                    if(item.status == 'success') {
                        this.tasks.push(item.data);
                        this.task = {
                            title: '',
                            description: '',
                            due_date: moment().format('YYYY-MM-DD hh:mm:ss'),
                            status: '',
                            _token: task._token
                        };

                    }
                    else
                        alert(item.msg);
                });
            },
            remove: function(task){
                var resource = this.$resource('/tasks/delete');

                resource.save({},task, function (item, status, request) {
                    if(item.status == 'success') {
                        this.tasks.pop(task);
                        this.task = {
                                    title: '',
                                    description: '',
                                    due_date: moment().format('YYYY-MM-DD hh:mm:ss'),
                                    status: '',
                                    _token: task._token
                                };

                    }
                    else
                        alert(item.msg);
                });
            },
            mark: function(task){

                if(task.status){

                    var resource = this.$resource('/tasks/:id/active');

                    resource.get({id: task.id}, function (item, status, request) {
                        if(item.status == 'error')
                            alert(item.msg);
                    });
                }
                else{
                    var resource = this.$resource('/tasks/:id/deactive');

                    resource.get({id: task.id}, function (item, status, request) {
                        if(item.status == 'error')
                            alert(item.msg);
                    });
                }
            },
            showdue:function(){
                this.listdue = true;
            },
            showcomplete: function(){
                this.listdue = false;
            }

        }
    });

    $('#datetimepicker1').datetimepicker({
        sideBySide: true,
        defaultDate: moment().format('YYYY-MM-DD hh:mm:ss'),
    });
    $('#datetimepicker1').find('input[name="due_date"]').val(moment().format('YYYY-MM-DD hh:mm:ss'));
    setInterval(function(){
        vue.time = moment();
    });
	
	vue.$watch('tasks', function(newvalue, oldval) {

        $.each(newvalue,function(index,value){

            var date  = moment(value.due_date),
                today = moment();

            if (date.isSame(today, 'd')) {
                newvalue[index].is_due = true;
            } else {
                newvalue[index].is_due = false;
            }

        });
        console.log(newvalue);
    }, {
        deep: true
    });
	
 	setInterval(function(){
        vue.time = moment().format('YYYY-MM-DD hh:mm:ss');
    },1000);

    vue.list();
});



