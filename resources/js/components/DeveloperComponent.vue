<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="s-email">Search by email:</label>
                            <input
                                type="text"
                                name="s-email"
                                id="s-email"
                                class="form-control"
                                placeholder="Write here ..."
                                v-model="search"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>List of developers</h1>
                    </div>

                    <div class="modal" :class="{active:modal}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label">Detail of developer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close" @click="hideDetail"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control bg-white" v-model="developer.name" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control bg-white" v-model="developer.email" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control bg-white" v-model="developer.phone" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control bg-white" v-model="developer.address" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="position">Position</label>
                                        <input type="text" name="position" id="position" class="form-control bg-white" v-model="developer.position" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="salary">Salary</label>
                                        <input type="number" name="salary" id="salary" class="form-control bg-white" v-model="developer.salary" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="skills">Skills</label>
                                        <textarea name="skills" id="skills" class="form-control bg-white" v-model="developer.skills" disabled></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal" @click="hideDetail">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col" colspan="2" class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="developer in developers" :key="developer.id">
                                    <th scope="row">{{ developer.id }}</th>
                                    <td>{{ developer.name }}</td>
                                    <td>{{ developer.email }}</td>
                                    <td>{{ developer.position }}</td>
                                    <td>$ {{ developer.salary }}</td>
                                    <td>
                                        <button class="btn btn-primary" @click="showDetail(developer.id)">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>

<script>
    export default {
        data() {
            return {

                developer:{
                    id: null,
                    name:'',
                    phone:'',
                    address:'',
                    skills:'',
                    email:'',
                    position:'',
                    salary: null
                },

                developers: Object,
                modal: false,
                search: null
            }
        },
        methods: {
            async list() {
                const { data } = await axios.get('developers')
                this.developers = data
            },
            async getNewList() {
                const { data } = await axios.post('developers-filter', {
                    email: this.search
                })

                this.developers = data
            },
            showDetail(id){
                const developer = this.developers.find(developer => developer.id === id)
                this.developer = developer
                this.modal = true
            },
            hideDetail(){
                this.modal = false
            },
        },
        watch: {
            search(newValue, oldValue) {
                if( newValue == '') return
                this.getNewList()
            }
        },
        mounted() {
            this.list()
        },
    }

</script>

<style>
    .active{
        display: list-item;
        opacity: 1;
        background: rgba(0, 0, 0, 0.541);
    }
</style>
