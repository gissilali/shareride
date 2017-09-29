<template>
    <div class="form-group">
        <gmap-autocomplete @place_changed="setPlace"></gmap-autocomplete>
        <input type="hidden" :name="inputName" v-model="place">
    </div>
</template>

<script>
    export default {
        props: ['inputName'],
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
                place: ''
            }
        },

        methods: {
            setPlace(place) {
                console.log(place.formatted_address);
                this.place = place.formatted_address;
            }
        }
    }
</script>
<style>
    input[type="text"] {
        display: block;
        width: 100%;
        height: 38px;
        padding: 7px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555555;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #e7e7e7;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
</style>
