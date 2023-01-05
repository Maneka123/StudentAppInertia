

<template>
    <AppLayout><template #content>
        
        <div class="container">
    <div class="row">
        <div class="col-lg-12 text-center" >
            <h1 class="page-title">Student List</h1>


<form @submit.prevent="taskStore" method="POST" enctype="multipart/form-data" >
    
            <div class="col-lg-12  mt-5">
                    <div class="row">
                        <div class="col-lg-8"> <div class="form-group">

<input name="name" v-model="task_form.name" class="form-control" type="text" placeholder="Full Name" aria-label="default input example">
<input name="image"  v-on:change="processFile" class="form-control" type="file" placeholder="Image" aria-label="default input example" accept="image/*">
<input name="age" v-model="task_form.age" class="form-control" type="number" placeholder="Age" aria-label="default input example">



                </div></div>
                        <div class="col-lg-4"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </div>
               
                    
            </div>
        </form>
        </div>

<br><br><br><br>

        <div class="col-lg-12 mt-5">

            <div>
            <br><br><br><br>
           <!-- {{tasks}}-->
            <table class="table table-dark table-striped" >
  <thead>
    <tr>
      <th scope="col">Count</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Age</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <!--@foreach($tasks as $key=>$student)-->
    <tr v-for="(task,key) in task_list">
      <th scope="row">{{++key}}</th>
      <td>{{task.name}}</td>
      <td><img src="{{task.image}}" wisth="100px"></td>
      <td>{{task.age}}</td>
      <td>
        
            <span v-if="task.done==0" span class="badge bg-warning">Inactive</span>
       
            <span v-else class="badge bg-success">Active</span>
        
      </td>
      <td><button type="button" @click.prevent="deleteTask(task.id)"  class ="btn btn-danger">Delete</button>
      <button type="button" @click.prevent="doneTask(task.id)" class ="btn btn-success">Change status</button>
      <button type="button" @click.prevent="editTask(task.id)"  value="{{task.id}}" class="editbtn"  >Update Student</button></td>

    </tr>
    
    
  </tbody>
</table>




            </div>





        </div>
    </div>

</div>




    </template>
<template #modals>

    <div class="modal" id="taskEdit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>

        <form @submit.prevent="taskUpdate" method="POST" enctype="multipart/form-data" >
    
    <div class="col-lg-12  mt-5">
            <div class="row">
                <div class="col-lg-8"> <div class="form-group">

<input name="name" v-model="task_update_form.name" class="form-control" type="text" placeholder="Full Name" aria-label="default input example">
<input name="image"  v-on:change="processFile" class="form-control" type="file" placeholder="Image" aria-label="default input example" accept="image/*">
<input name="age" v-model="task_update_form.age" class="form-control" type="number" placeholder="Age" aria-label="default input example">



        </div></div>
                <div class="col-lg-4"><button type="submit" class="btn btn-primary">Submit</button></div>
            </div>
       
            
    </div>
</form>

      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>


</template>

</AppLayout>
    </template>
    
    <script>
import AppLayout from '@/Layouts/App.vue'
import { computed } from "vue"
import { usePage } from '@inertiajs/inertia-vue3'
export default{
    components:{
        AppLayout
    },
   /* props:{
        tasks:Array
    },*/
   /* setup(){
        const tasks=computed(()=>usePage().props.value.tasks);
        return{
            tasks
        }

    },*/
    data(){
        return{
            task_form:{
                title:'',
                selectedFile:null,
                age:''
            },
            task_update_form:{
                title:'',
                selectedFile:null,
                age:''
            },
            task_list:[]
        }
    },
    beforeMount(){
        /*this.task={
            title:'',
            selectedFile:null,
            age:''
        }*/
        //this.task_list=this.tasks;
        this.getTasks();

    },
    methods:{
        async getTasks(){
            const tasks=(await axios.get(route('student.list'))).data
            this.task_list=tasks

        },
        async taskStore(){
                //this.$inertia.post('/student/store',this.task)
                await axios.post(route('student.store'),this.task_form)
                //console.log(tasks);
                this.getTasks();
                //this.$set(this,'tasks',tasks)
                //this.$set(this.tasks,tasks)
                this.task_form.name='' //empty the fields after submission
                this.task_form.age=''
                
        },
        processFile(event) {
                    this.selectedFile = event.target.files[0]
      // do something with the selected file...
    },
    async deleteTask(id){
      await axios.delete(route('student.delete',id))
        this.getTasks();
    },
    async doneTask(id){
      await axios.get(route('student.done',id))
        this.getTasks();
    },
    async editTask(id){
        const task=(await axios.get(route('student.get',id))).data
        this.task_update_form.name=task.name
        this.task_update_form.image=task.image
        this.task_update_form.age=task.age
        $('#taskEdit').modal('show')
    },
    async taskUpdate(){
        await axios.post(route('student.update',this.task_update_form.id),this.task_update_form)
        this.getTasks();
        $('#taskEdit').modal('hide')

    },
        
    }
}
</script>
    
    <style  scoped>
 .page-title{
        padding-top:15vh;
        font-size:5rem;
        color: #6d86d2;
    }

    </style>