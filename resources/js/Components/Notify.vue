<script>
import { ref, onMounted } from "vue";

export default {
  props: ["user", "user_notifications"],
  setup(props) {
    let users = ref([]);
    let notifications = ref([]);
    const notificationOpen = ref(false);

    onMounted(() => {
      notifications.value = props.user_notifications;
      console.log(notifications.value);
    });

    Echo.private("post_like." + props.user.id).notification((notification) => {
      notifications.value.push(notification.notification);
      console.log(notification);
    });

    return {
      notifications,
      notificationOpen,
    };
  },
};
</script>
<template>
  <div class="flex items-center">
    <div class="flex items-center">
      <div class="relative">
        <button
          @click="notificationOpen = !notificationOpen"
          class="flex mx-4 text-gray-600 relative focus:outline-none"
        >
          <div
            class="
              w-4
              h-4
              rounded-full
              text-xs
              absolute
              left-4
              -top-1
              bg-green-600
              text-white
            "
          >
            {{ notifications.length }}
          </div>
          <svg
            class="h-8 w-8"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>

        <div
          v-show="notificationOpen"
          @click="notificationOpen = false"
          class="fixed inset-0 h-full w-full z-10"
        ></div>

        <div
          v-show="notificationOpen"
          class="
            absolute
            right-0
            mt-2
            w-80
            bg-white
            rounded-lg
            shadow-xl
            overflow-hidden
            z-10
          "
          style="width: 20rem"
        >
          <a
            v-for="notify in notifications"
            :key="notify"
            href="#"
            class="
              flex
              items-center
              px-4
              py-3
              text-gray-600
              hover:text-white hover:bg-indigo-600
              -mx-2
            "
          >
            <strong>{{ notify.data.user_name }}</strong> Liked your post
            <b>{{ notify.data.post_title }}</b>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>