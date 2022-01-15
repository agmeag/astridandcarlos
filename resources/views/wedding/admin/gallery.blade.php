@extends('layout.layout')
@section('head')
<style>
    .app-ct {
        background-color: transparent !important;
        width: 100%;
        min-width: 100%;
        height: 100%;
        min-height: 100%;
        overflow: hidden;
        padding: 16px 15px 62px 15px;
        background-color: #343434 !important;
    }

    .inner-content {
        width: 100%;
        height: 100%;
        min-height: 100%;
        min-width: 100%;
        box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
        border-radius: 8px;
    }

    .image-ct {
        width: 100%;
        /* padding: 18px; */
        height: 100%;
        overflow: hidden;
        border-radius: 12px;
    }

    .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;

    }

    @media (max-width: 768px) {
        .image-ct {
            /* padding: 10px !important; */
        }

        .app-ct {
            padding: 8px 5px 42px 5x !important;
        }
    }

    .flex-center {
        display: flex;
        justify-content: center;
        align-items: center
    }

    .loading {
        width: 100%;
        height: 100%;
        min-height: 100%;
        min-width: 100%;
    }

    .opacity-0 {
        opacity: 0;
    }

    * {
        transition: all 300ms;
    }

    .display-0 {
        display: none;
    }

    .display-1 {
        display: flex;
    }

    [v-cloak] {
        display: none;
    }

    .flex-w-ct {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .single-img-cnt {
        /* width: 60%;
        height: 200px;
        overflow: hidden;
        border-radius: 12px;
        padding: 20px; */
        display: flex;
        justify-content: center;
    }

    .single-img {
        border-radius: 25px;
        object-fit: cover;
        width: 100%;
        height: 430px;
    }



    .change-btn {
        background-color: #09F;
        color: white;
    }

    .left-btn {
        background-color: #3AAF85;
        color: white;
    }

    .right-btn {
        background-color: #25D366;
        color: white;
    }

    .delete-btn {
        background-color: #DF2029;
        color: white;
    }

    /* .btn-ct {
        margin: 2px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bolder;
        border-radius: 12px;
        padding: 10px;
        transition: all 0.5s;
    } */

    .btn-ct:hover {
        background-color: #fff;
        color: #000;
    }

    #app {
        width: 100%;
        overflow-x: none;
        background-color: #000000d6;
        height: 100%;
        min-height: 100%;
    }

    .w-100 {
        width: 100%;
    }

    .buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        /* overflow-x: scroll; */
        width: 100%;
        background-color: transparent;
    }

    .btn-ct {
        background-color: transparent;
        /* border-right: 3px solid #7d7d7d;
        border-left: 3px solid #7d7d7d; */
        padding: 10px 10px;
        font-weight: bolder;
        cursor: pointer;
        /* width: 110px; */
    }

    .divisor {
        width: 2px;
        background-color: #646464;
        height: 40px;
        min-height: 100%;
        height: 40px;
    }

    .flex {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .ma-0-pa-0 {
        padding: 0;
        margin: 0;
    }

    .content {
        background-color: #000000db;
    }

    .bordered {
        border-radius: 12px;
    }

    .b-font {
        font-size: 2rem;
    }

    /* .multiple-img-cnt {
        height: 200px;
        border-radius: 12px;
        width: 200px;
    } */

    .multiple-img {
        height: 200px;
        border-radius: 12px;
        width: 200px;
        object-fit: cover;
    }

    .multiple-delete {
        margin-top: -216px;
        margin-left: 184px;
        background-color: #ff00007a !important;
        color: #ffffff82;
        border-radius: 12px;
        margin-bottom: 200px;
        position: relative;
        padding: 8px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .multiple-delete:hover {
        background-color: #DF2029 !important;
        color: #fff;
    }

    .multiple-restore {
        margin-top: -216px;
        margin-left: 184px;
        background-color: #25d36573 !important;
        color: #ffffff82;
        border-radius: 12px;
        margin-bottom: 200px;
        position: relative;
        padding: 8px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .multiple-restore:hover {
        background-color: #25D366 !important;
        color: #fff;
    }

    .icon {
        font-size: 2rem;
    }

    .img-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    @media (max-width: 768px) {
        .img-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 165px);
            overflow-y: auto;
        }
    }
</style>
<script src="/assets/lottiefiles/lottie-player.js"></script>

@endsection
@section('content')
<div id="app" class="unselectable app-ct" v-cloak>
    <div class="inner-content">
        <v-btn v-on:click="addFile()" v-if="!saving" rounded>
            <v-icon>mdi-camera</v-icon>
        </v-btn>
        <input type="file" ref="file" accept="image/png, image/gif, image/jpeg" @change="processFile($event)"
            style="display: none">
        <template v-if="!multiple">
            <div class="buttons">
                <div v-on:click="toogleImagesGrid()" class="change-btn btn-ct icon flex-center">
                    <i class='bx bxs-grid-alt'></i>
                </div>
                <div v-on:click="deleteFile(idimage,index)" class="delete-btn btn-ct icon flex-center">
                    <i class='bx bxs-trash'></i>
                </div>
            </div>
            <!-- <div> -->
            <!-- </div> -->
            <div class="flex-w-ct">
                <div v-on:click="previousImage" class="left-btn btn-ct bordered flex b-font">
                    <i class='bx bxs-left-arrow'></i>
                </div>
                <div class="single-img-cnt">
                    <img :src="image" alt="" class="single-img">
                </div>
                <div v-on:click="nextImage" class="right-btn btn-ct bordered flex b-font">
                    <i class='bx bxs-right-arrow'></i>
                </div>
            </div>
        </template>

        <template v-if="multiple">
            <div class="buttons">
                <div v-on:click="previousImage" class="change-btn btn-ct icon flex-center">
                    <i class='bx bxs-left-arrow'></i>
                </div>
                <div v-on:click="toogleImagesGrid()" class="change-btn btn-ct icon flex-center">
                    <i class='bx bxs-carousel'></i>
                </div>
                <div v-on:click="nextImage" class="change-btn btn-ct icon flex-center">
                    <i class='bx bxs-right-arrow'></i>
                </div>
            </div>
            <div class="img-container">
                <template v-for="(item, i) in current_files">
                    <div class="multiple-img-cnt">
                        <img :src="item.file" alt="" class="multiple-img">
                        <div v-on:click="deleteFile(item.idphoto,item.index,i)" class="multiple-delete"
                            v-if="item.deleted==0">
                            <i class='bx bxs-trash'></i>
                        </div>
                        <div v-on:click="restoreFile(item.idphoto,item.index,i)" class="multiple-restore"
                            v-if="item.deleted==1">
                            <i class='bx bx-reset'></i>
                        </div>
                    </div>

                </template>
            </div>
        </template>
    </div>
</div>
@endsection
@section('scripts')
<script type="module">
    axios.defaults.headers.common = {
        "X-Requested-With": "XMLHttpRequest",
    };

    new Vue({
        el: '#app',
        vuetify: new Vuetify({
        }),
        data() {
            return {
                variable: null,
                files: [],
                index: 0,
                image: null,
                idimage: null,
                current_files: [],
                multiple: true,
                baseUrl: '/manual/',
                saving: false,
            };
        },

        beforeMount() {
            this.getFiles();
        },
        mounted() {
            window.addEventListener("keyup", (ev) => {
                this.detectKey(ev); // declared in your component methods
            });
        },

        created() {

        },

        destroyed() {
        },
        methods: {
            addFile() {
                this.$refs.file.click();
            },
            detectKey(ev) {
                let keycode = ev.keyCode;
                // this.emptyDialog = true;
                //Key Space
                switch (keycode) {
                    // Key Space
                    case 32:
                        // this.toogleImagesGrid();
                        break;
                    // Left
                    case 37:
                        this.previousImage();
                        break;
                    // Right
                    case 39:
                        this.nextImage();
                        break;
                }
            },

            changeImages() {
                if (this.multiple) {
                    this.current_files = [];
                    for (var i = this.index; i < this.index + 20; i++) {

                        if (this.files[i]) {
                            let obj = {
                                index: i,
                                deleted: this.files[i].deleted,
                                file: this.files[i].url,
                                idphoto: this.files[i].idphoto
                            };
                            this.current_files.push(obj);
                        }
                    }
                } else {
                    this.image = this.files[this.index] ? this.files[this.index].url : null;
                }
            },

            toogleImagesGrid() {
                this.multiple = !this.multiple;
                this.changeImages();
            },

            previousImage() {
                if (this.index > 0) {
                    this.index -= 1;
                }
                this.changeImages();
                this.newName = null;
            },
            nextImage() {
                this.index += 1;
                if (this.files.length == this.index) {
                    this.index = this.files.length - 1;
                }
                this.changeImages();
                this.newName = null;
            },
            getFiles() {
                console.log('se hizo')
                this.loading = true;
                axios.get('/admin/admin/admin/gallery/get_list',
                    {})
                    .then((response) => {
                        this.files = response.data;
                        this.loading = false;
                        this.changeImages();
                    })
                    .catch((error) => {
                        this.loading = false;
                        window.console.log(error);
                        if (error.response) {
                            window.console.log(error.response);
                            if (error.response.status == 401) {
                                location.reload();
                            }
                        }
                    })
            },

            deleteFile(id, i = null, i2 = null) {
                // console.log('se hizo')
                this.loading = true;
                let formData = new FormData();
                formData.append("id", id);
                axios.post('/admin/admin/admin/gallery/delete', formData)
                    .then((response) => {
                        if (this.multiple) {
                            this.files.splice(i, 1);
                            this.current_files.splice(i2, 1);
                        } else {
                            this.files.splice(i, 1);
                        }
                        this.loading = false;
                    })
                    .catch((error) => {
                        this.loading = false;
                        window.console.log(error);
                        if (error.response) {
                            window.console.log(error.response);
                            if (error.response.status == 401) {
                                location.reload();
                            }
                        }
                    })
            },

            restoreFile(id, i = null, i2 = null) {
                // console.log('se hizo')
                this.loading = true;
                let formData = new FormData();
                formData.append("id", id);
                axios.post('/admin/admin/admin/gallery/restore', formData)
                    .then((response) => {
                        if (this.multiple) {
                            this.files.splice(i, 1);
                            this.current_files.splice(i2, 1);
                        } else {
                            this.files.splice(i, 1);
                        }
                        this.loading = false;
                    })
                    .catch((error) => {
                        this.loading = false;
                        window.console.log(error);
                        if (error.response) {
                            window.console.log(error.response);
                            if (error.response.status == 401) {
                                location.reload();
                            }
                        }
                    })
            },

            processFile(event) {
                let formData = new FormData();
                formData.append('image_file', event.target.files[0]);
                this.saving = true;
                axios.post('/admin/admin/admin/gallery/save-image', formData)
                    .then((response) => {
                        // this.trivia_list.splice(this.trivia.index, 1, response.data);
                        let item = response.data;
                        this.saving = false;
                        let obj = {
                            index: this.files.length,
                            deleted: item.deleted,
                            file: item.url,
                            idphoto: item.idphoto
                        };
                        this.files.push(item);
                        this.current_files.push(obj);
                    })
                    .catch((error) => {
                        this.saving = false;
                        window.console.log(error);
                        if (error.response) {
                            window.console.log(error.response);
                            if (error.response.status == 401) {
                                location.reload();
                            }
                        }
                    });
            },
        },
    });
</script>
@endsection