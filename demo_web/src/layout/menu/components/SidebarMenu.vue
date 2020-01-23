<template>
  <div class="v-sidebar-menu" :class="[!isCollapsed ? 'vsm-default' : 'vsm-collapsed']" :style="{'width': sidebarWidth, 'display': ((isMobile && btnHiddenMenu) ? 'none' : 'block')}" @mouseleave="mouseLeave">
    
    <div class="vsm-list scrollbar-custom" style="padding-bottom: 60px;" :style="[{'height' : '100%', 'margin-top': '60px'}, {'overflow' : 'hidden auto'}]">
      <!-- <item key="pg-inicial" :item="{ href: '/', title: 'Página Inicial', icon: 'fa fa-user' }" :firstItem="true" :isCollapsed="isCollapsed" />
      <div class="line-menu"></div> -->

      <template v-for="(item, index) in menu">
         <template v-if="item.header">
           <div v-if="!isCollapsed" :key="index" class="vsm-header">{{item.title}}</div>
         </template>
         <item v-else :key="index" :item="item" :firstItem="true" :isCollapsed="isCollapsed"/>
      </template>


    </div>
    <div v-if="isCollapsed" :style="[{'position' : 'absolute'}, {'top' : `${mobileItemPos}px`}, {'left' : '0px'}, {'z-index' : 30}, {'width' : '240px'}]">
      <mobile-item :item="mobileItem" />
      <transition name="slide-animation">
        <div class="vsm-mobile-bg" v-if="mobileItem" :style="[{'position' : 'absolute'}, {'left' : '0px'}, {'right' : '0px'}, {'top' : '0px'}, {'height' : `${mobileItemHeight}px`}]"></div>
      </transition>
      <div class="vsm-dropdown" :style="[{'position' : 'absolute'}, {'top' : `${mobileItemHeight}px`}, {'left' : sidebarWidth}, {'right' : '0px'}, {'max-height' : `calc(100vh - ${mobileItemPos + mobileItemHeight}px)`}, {'overflow-y' : 'auto'}]">
        <transition name="show-animation">
          <div class="vsm-list" v-if="mobileItem && mobileItem.child">
            <sub-item v-for="(subItem, index) in mobileItem.child" :item="subItem" :key="index"/>
          </div>
        </transition>
      </div>
    </div>
    
    <button v-if="!isMobile" class="collapse-btn" @click="toggleCollapse"></button>

  </div>
</template>

<script>
import Item from './Item.vue'
import SubItem from './SubItem.vue'
import MobileItem from './MobileItem.vue'

export default {
  name: 'SidebarMenu',
  components: {
    Item,
    SubItem,
    MobileItem
  },
  props: {
    menu: {
      type: Array,
      required: true
    },
    collapsed: {
      type: Boolean,
      default: false
    },
    mobile: {
      type: Boolean,
      default: false
    },
    btnHiddenMenu: {
      type: Boolean,
      default: false
    },
    width: {
      type: String,
      default: '240px'
    },
    widthCollapsed: {
      type: String,
      default: '60px'
    }
  },
  data() {
    return {
      sidebarWidth: this.collapsed ? this.widthCollapsed : this.width,
      isCollapsed: this.collapsed,
      isMobile: this.mobile,
      mobileItem: null,
      mobileItemPos: 0,
      mobileItemHeight: 0,
      closeTimeout: null
    }
  },
  created() {

    this.checkCollapse();

    this.$on('mouseEnterItem', (val) => {
      this.mobileItem = val.item
      this.mobileItemPos = val.pos
      this.mobileItemHeight = val.height
    })

    this.$on('clickItem', () => {
      if (this.closeTimeout) clearTimeout(this.closeTimeout)
      this.closeTimeout = setTimeout(() => {
        this.mouseLeave()
      }, 600)
    })
    
    window.addEventListener("resize", () => {
      this.checkCollapse();      
    });

  },
  methods: {
    mouseLeave() {
      this.mobileItem = null
    },
    toggleCollapse() {
      this.isCollapsed = !this.isCollapsed
      this.sidebarWidth = this.isCollapsed ? this.widthCollapsed : this.width
      this.$emit('collapse', this.isCollapsed)
    },
    checkCollapse() {

      if(window.innerWidth <= 1200){

        this.isMobile = true;
        this.$emit('mobile', true);
      
      }else{
        this.isMobile = false;
        this.$emit('mobile', false);

      }

      this.isCollapsed = false;
      this.sidebarWidth = this.isCollapsed ? this.widthCollapsed : this.width
      this.$emit('collapse', this.isCollapsed)

    }
  },
}
</script>
