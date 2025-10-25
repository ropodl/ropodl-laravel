<!-- eslint-disable vue/multi-word-component-names -->
<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const showPassword = ref(false);

const submit = () => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password');
    },
  });
};
</script>

<template>
  <Head title="Log in" />
  <GuestLayout title="Log In." class="mt-16">
    <template #title> Log In. </template>
    <v-container>
      <v-row class="pb-16">
        <v-col cols="12" md="4" class="fill-height">
          <template v-if="status">
            <div class="mb-4 text-sm font-medium text-green-600">
              {{ status }}
            </div>
          </template>

          <form @submit.prevent="submit">
            <v-text-field
              v-model="form.email"
              autofocus
              placeholder="Enter Email Address"
              density="comfortable"
              :error-messages="form.errors.email"
            ></v-text-field>

            <v-text-field
              v-model="form.password"
              placeholder="Enter Password"
              density="comfortable"
              :type="showPassword ? 'text' : 'password'"
              :error-messages="form.errors.password"
            >
              <template #append-inner>
                <v-icon @click="showPassword = !showPassword">
                  {{ showPassword ? 'mdi-eye-off-outline' : 'mdi-eye-outline' }}
                </v-icon>
              </template>
            </v-text-field>
            <v-checkbox v-model="form.remember" label="Remember Me"></v-checkbox>
            <div class="d-flex align-center justify-space-between">
              <!-- <template v-if="canResetPassword">
                                <Link
                                    :href="route('password.request')"
                                    as="VBtn"
                                >
                                    <v-btn> Forgot your password? </v-btn>
                                </Link>
                            </template> -->

              <v-btn color="primary" type="submit" class="px-10" :disabled="form.processing">
                Log in
              </v-btn>
            </div>
          </form>
        </v-col>
      </v-row>
    </v-container>
  </GuestLayout>
</template>
