<template>
  <div id="example-5">
    <v-layout row-md column child-flex-md>
      <v-card light hover class=" ma-1">
        <v-card-media
          src="/static/doc-images/cards/sunshine.jpg"
          height="200px"
        >
        </v-card-media>
        <v-card-title primary-title>
          <div>
            <div class="headline">Top western road trips</div>
            <span class="grey--text">1,000 miles of wonder</span>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-btn flat>Share</v-btn>
          <v-btn flat class="purple--text">Explore</v-btn>
          <v-spacer></v-spacer>
          <v-btn icon @click.native="show = !show">
            <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
          </v-btn>
        </v-card-actions>
        <v-slide-y-transition>
          <v-card-text v-show="show">
            I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
          </v-card-text>
        </v-slide-y-transition>
      </v-card>
      <v-card light hover class=" ma-1">
        <v-card-text>one</v-card-text>
      </v-card>
      <v-card light hover class=" ma-1">
        <v-card-text>one</v-card-text>
      </v-card>
      <v-card light hover class=" ma-1">
        <v-card-text>one</v-card-text>
      </v-card>
      
    </v-layout>
    <v-layout row-sm column child-flex-sm>
      <v-card dark class="primary ma-1">
        <v-card-text>one</v-card-text>
      </v-card>
      <v-card dark class="secondary ma-1">
        <v-card-text>two</v-card-text>
      </v-card>
      <v-card dark class="accent ma-1">
        <v-card-text>three</v-card-text>
      </v-card>
      <v-card dark class="accent ma-1">
        <v-card-text>three</v-card-text>
      </v-card>
     
    </v-layout>
  </div>
</template>
<script>
  export default {
    data: () => ({
      show: false
    })
  }
</script>
<style>
  #example-5 {
    color: #fff;
    text-align: center;
  }

  #example-5 .card {
    margin-bottom: 16px;
  }
</style>