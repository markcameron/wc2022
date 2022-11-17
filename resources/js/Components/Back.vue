<template>
  <div class="max-w-5xl mx-auto sm:px-6">
      <Link :href="href" as="button" class="mt-4 ml-4 w-10 text-white font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fillRule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clipRule="evenodd" />
        </svg>
    </Link>
  </div>
</template>

<script>
  import { Link } from "@inertiajs/inertia-vue3";
  import { Inertia } from '@inertiajs/inertia'

  export default {
    components: {
      Link,
    },
    props: ["href"],
    methods: {
      goBack() {
        console.log('goBack', sessionStorage.getItem("prev"))
        // Check sessionStorage
        if (!sessionStorage.getItem("prev")) { // This page was navigated off-site
          this.$inertia.visit(this.href);
        } else {
          history.back();
          //window.history.back();
        }
      },
    },
  };
  </script>
