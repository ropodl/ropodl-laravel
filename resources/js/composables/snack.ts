import { ref } from 'vue';

const show = ref<boolean>(false);
const text = ref<string>('');
const color = ref<string>('');

export const snackbar = () => {
  const setSnackbar = (msg: string, colors: string) => {
    text.value = msg;
    color.value = colors;
    show.value = true;
  };

  return {
    show,
    text,
    color,
    setSnackbar,
  };
};
