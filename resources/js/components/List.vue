<template>
    <div class="row">
        

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Item</h4>
                </div>
                <div class="card-body">
                    
                    <table id="itemTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <td rowspan="2" class="text-center" style="cursor:pointer;vertical-align:middle;font-weight:500;">Sl</td>
                                <td @click="sort('itemCode')" rowspan="2" class="text-center" style="cursor:pointer;vertical-align:middle;font-weight:500;">Code</td>
                                <td @click="sort('itemName')" rowspan="2" class="text-center" style="cursor:pointer;vertical-align:middle;font-weight:500;">Name</td>
                                <td @click="sort('brand')" rowspan="2" class="text-center" style="cursor:pointer;vertical-align:middle;font-weight:500;">Brand</td>
                                <td colspan="5" class="text-center" style="font-weight:500;">Quantity</td>
                            </tr>
                            <tr>
                                <td @click="sort('packedQuantity')" rowspan="2" class="text-center" style="cursor:pointer;font-weight:500;">Packed</td>
                                <td @click="sort('bulkQuantity')" rowspan="2" class="text-center" style="cursor:pointer;font-weight:500;">Bulk</td>
                                <td @click="sort('material1Quantity')" rowspan="2" class="text-center" style="cursor:pointer;font-weight:500;">Material-1</td>
                                <td @click="sort('material2Quantity')" rowspan="2" class="text-center" style="cursor:pointer;font-weight:500;">Material-2</td>
                                <td @click="sort('material3Quantity')" rowspan="2" class="text-center" style="cursor:pointer;font-weight:500;">Material-3</td>
                            </tr>
                        </thead>
                        <tbody v-if="items.length > 0">
                            <tr v-for="(item,key) in items" :key="key">
                                <td>{{++key}}</td>
                                <td>
                                    <router-link class="btn btn-sm btn-outline-primary px-4" :to="{ name: 'item', params: { id: item.id } }" data-toggle="modal" v-bind:data-target="'#editlist'+item.id">{{ item.itemCode }}</router-link>
                                </td>
                                <td>{{item.itemName}}</td>
                                <td>{{item.brand}}</td>
                                <td>{{item.packedQuantity}}</td>
                                <td>{{item.bulkQuantity}}</td>
                                <td>{{item.material1Quantity}}</td>
                                <td>{{item.material2Quantity}}</td>
                                <td>{{item.material3Quantity}}</td>

                                <!-- Modal -->
                                <div v-if="modalShow"  class="modal fade" v-bind:id="'editlist'+item.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{item.itemCode}} : {{item.itemName}}
                                                <br/>
                                                Brand : {{item.brand}}
                                            </h5>
                                            <button type="button" class="btn btn-sm btn-danger close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form @submit.prevent="update(item.id)">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <div class="row form-group">
                                                            <div class="col-md-3"><label class="form-input-label">Packed : <strong>{{item.packedQuantity}}</strong></label></div>
                                                            <div class="col-md-4">Increase/Decrease</div>
                                                            <div class="col-md-5"><input type="number" v-model="packed" class="form-control"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <div class="row form-group">
                                                            <div class="col-md-3"><label class="form-input-label">Bulk : <strong>{{item.bulkQuantity}}</strong></label></div>
                                                            <div class="col-md-4">Increase/Decrease</div>
                                                            <div class="col-md-5"><input type="number" v-model="bulk" class="form-control"></div>
                                                        </div>
                                                    </div>

                                                    <div v-if="item.production == 1">
                                                        <div class="col-12 mb-2">
                                                            <div class="row form-group">
                                                                <div class="col-md-3"><label class="form-input-label">Material-1 : <strong>{{item.material1Quantity}}</strong></label></div>
                                                                <div class="col-md-4">Increase/Decrease</div>
                                                                <div class="col-md-5"><input type="number" v-model="m1" class="form-control"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <div class="row form-group">
                                                                <div class="col-md-3"><label class="form-input-label">Material-2 : <strong>{{item.material2Quantity}}</strong></label></div>
                                                                <div class="col-md-4">Increase/Decrease</div>
                                                                <div class="col-md-5"><input type="number" v-model="m2" class="form-control"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-112 mb-2">
                                                            <div class="row form-group">
                                                                <div class="col-md-3"><label class="form-input-label">Material-3 : <strong>{{item.material3Quantity}}</strong></label></div>
                                                                <div class="col-md-4">Increase/Decrease</div>
                                                                <div class="col-md-5"><input type="number" v-model="m3" class="form-control"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                    <!-- end -->
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="9" align="center">No Categories Found.</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                        <button @click="prevPage" class="btn btn-sm btn-primary"><i class="fa fa-backward"></i></button> 
                        
                        <button @click="nextPage" class="btn btn-sm btn-primary" style="margin-left:5px;"><i class="fa fa-forward"></i></button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: "items",
    data:function(){
        return {
            items: [],
            packed: '',
            bulk: '',
            m1: '',
            m2: '',
            m3: '',
            pageSize:20,
            currentPage:1,
            currentSort:'itemName',
            currentSortDir:'asc',
            modalShow: true
        }
    },
    mounted(){
        this.getItems()
    },
    methods:{

        sort:function(s) {
            //if s == current sort, reverse
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            }
            this.currentSort = s;
        },
        nextPage:function() {
            if((this.currentPage*this.pageSize) < this.items.length) this.currentPage++;
        },
        prevPage:function() {
            if(this.currentPage > 1) this.currentPage--;
        },

        async getItems(){
            await this.axios.get('/api/item').then(response => {
                this.items = response.data;
            }).catch(error=>{
                this.items = [];
            })
        },

        async update(id){
            let item = {
                packed : this.packed,
                bulk : this.bulk,
                m1 : this.m1,
                m2 : this.m2,
                m3 : this.m3
            }
            
            await this.axios.patch('/api/item/'+id,item).then(response=>{
                this.$router.push({name:"item"});
                this.$toast.info('Items updated successfully.');
                this.packed = '';
                this.bulk = '';
                this.m1 = '';
                this.m2 = '';
                this.m3 = ''; 
                
                this.$nextTick(function () {
                    this.getItems() // => 'updated'
                });
                this.modalShow = false;

            }).catch(error=>{
                console.log(error)
            })
        }
    },
    computed:{
        items:function() {
            return this.items.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            }).filter((row, index) => {
                let start = (this.currentPage-1)*this.pageSize;
                let end = this.currentPage*this.pageSize;
                if(index >= start && index < end) return true;
            });
        }
    }
}

</script>