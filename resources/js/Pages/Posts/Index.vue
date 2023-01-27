<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import PostNotify from "./PostNotify.vue";
const { posts, notifications } = defineProps({
  posts: Array,
  notifications: Array,
});
function LikePost(id) {
  router.put("/post-like/" + id);
}
</script>

<template>
  <Head title="Posts" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <!-- component -->
          <div class="overflow-x-auto">
            <div
              class="
                min-w-screen min-h-screen
                flex-col
                items-center
                justify-center
                bg-gray-100
                font-sans
                overflow-hidden
              "
            >
              <PostNotify
                :user="$page.props.auth.user"
                :user_notifications="notifications"
              />
              <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                  <table class="min-w-max w-full table-auto">
                    <thead>
                      <tr
                        class="
                          bg-gray-200
                          text-gray-600
                          uppercase
                          text-sm
                          leading-normal
                        "
                      >
                        <th class="py-3 px-6 text-left">Titile</th>
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-center">Like</th>
                      </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                      <tr
                        v-for="post in posts"
                        :key="post.id"
                        class="border-b border-gray-200 hover:bg-gray-100"
                      >
                        <td class="py-3 px-6 text-center">
                          <span
                            class="
                              bg-purple-200
                              text-purple-600
                              py-1
                              px-3
                              rounded-full
                              text-xs
                            "
                            >{{ post.title }}</span
                          >
                        </td>
                        <td class="py-3 px-6 text-center">
                          <span
                            class="
                              bg-purple-200
                              text-purple-600
                              py-1
                              px-3
                              rounded-full
                              text-xs
                            "
                            >{{ post.user.name }}</span
                          >
                        </td>

                        <td class="py-3 px-6 text-center">
                          <button
                            @click="LikePost(post.id)"
                            class="bg-indigo-500 rounded-lg px-2 py-1"
                          >
                            Like
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
