<template>
<tabs v-model="activeTab" nav-style="tabs" justified>
  <tab header="zero">
    Zero
  </tab>
  <tab header="one">
    One
  </tab>
  <tab header="two" disabled>
    Two
  </tab>
  <tab-group header="group1">
    <tab header="three">
      Three
    </tab>
    <tab header="four" disabled>
      Four
    </tab>
  </tab-group>
  <tab-group header="group2">
    <tab header="five">
      Five
    </tab>
  </tab-group>
</tabs>
</template>

<script>
var tab = require('vue-strap/src/Tab');
var tabs = require('vue-strap/src/Tabs');
var tabGroup = require('vue-strap/src/TabGroup');

export default {
  mounted() {
    console.log('Component mounted.')
  },
  data: function () {
    return {
      activeTab: 0
    }
  },
  components: {
    tab,
    tabs,
    tabGroup
  }
}
</script>