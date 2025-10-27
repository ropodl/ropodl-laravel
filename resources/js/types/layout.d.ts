export type navItem = {
  icon: string;
  title: string;
  subtitle?: string;
  to?: string;
  subitems?: {
    title: string;
    to?: string;
    grand?: { title: string; to?: string }[];
  }[];
};
