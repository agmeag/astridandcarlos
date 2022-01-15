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
</style>
<script src="/assets/lottiefiles/lottie-player.js"></script>

@endsection
@section('content')
<div id="app" class="unselectable app-ct" v-cloak>
    <div class="inner-content">
        <div class="image-ct animate__animated animate__fadeIn" v-if="image!=null && !loading && display" id="image">
            <img :src="image" alt="" class="image">
        </div>
        <div v-else class="flex-center loading" style="background-color: white; border-radius: 12px;">
            <lottie-player src="/assets/lottiefiles/loading_dots.json" background="transparent" speed="1"
                style="width: 500px; height: 500px;" loop autoplay></lottie-player>
        </div>
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
                display: true,
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
            setInterval(() => {
                this.nextImage();
            }, 8000);
        },

        destroyed() {
        },

        methods: {
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

            nextImage() {
                if (this.files.length > 0) {
                    if (this.index >= this.files.length - 1) {
                        this.index = 0;
                    } else {
                        this.index += 1;
                    };
                } else {
                    this.index = 0;
                }

                // this.display = false;
                this.image = this.files[this.index].url;
                // this.display = true;
                this.$nextTick(() => {
                    document.getElementById("image").classList.remove("animate__fadeIn");
                    document.getElementById("image").classList.remove("display-1");
                    document.getElementById("image").classList.add("display-0");
                });
                setInterval(() => {
                    document.getElementById("image").classList.remove("display-0");
                    document.getElementById("image").classList.add("display-1");
                    document.getElementById("image").classList.add("animate__fadeIn");
                }, 200);
                // setInterval(() => {
                //     document.getElementById("image").classList.add("animate__fadeIn");
                // }, 300);
                // this.$nextTick(() => {
                //     this.display = true;
                // });

            },

            previousImage() {
                if (this.files.length > 0) {
                    if (this.index <= 0) {
                        this.index = 0;
                    } else {
                        this.index -= 1;
                    };
                } else {
                    this.index = 0;
                }
                this.image = this.files[this.index].url;
            },



            getFiles() {
                console.log('se hizo')
                this.loading = true;
                axios.get('/wedding/gallery/get_files',
                    {})
                    .then((response) => {
                        this.files = response.data;
                        this.loading = false;
                        this.index = 0;
                        this.image = this.files[this.index].url;
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
        },
    });
</script>
@endsection