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
        padding: 18px;
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
            padding: 10px !important;
        }

        .app-ct {
            padding: 8px 5px 42px 5x !important;
        }
    }
</style>
@endsection
@section('content')
<div id="app" class="unselectable app-ct" v-cloak>
    <div class="inner-content">
        <div class="image-ct">
            <img src="image" alt="" class="image">
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

            getLinks() {
                console.log('se hizo')
                this.loading = true;
                axios.get('/wedding/links/get_links',
                    {})
                    .then((response) => {
                        this.files = response.data;
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
        },
    });
</script>
@endsection