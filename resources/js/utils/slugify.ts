// Common stop words to remove (more comprehensive list)
const STOP_WORDS = new Set([
  'a',
  'an',
  'and',
  'are',
  'as',
  'at',
  'be',
  'by',
  'for',
  'from',
  'has',
  'he',
  'in',
  'is',
  'it',
  'its',
  'of',
  'on',
  'that',
  'the',
  'to',
  'was',
  'will',
  'with',
  'am',
  'been',
  'being',
  'have',
  'had',
  'were',
  'but',
  'or',
  'not',
  'this',
  'can',
  'could',
  'should',
  'would',
  'shall',
  'may',
  'might',
]);

/**
 * Creates a URL-friendly slug from a title string
 * @param title - The title to convert to a slug
 * @param options - Configuration options
 * @returns URL-friendly slug string
 */
export default (
  title?: string,
  options: {
    removeStopWords?: boolean;
    maxLength?: number;
    separator?: string;
  } = {},
): string => {
  if (!title?.trim()) return '';

  const { removeStopWords = true, maxLength = 100, separator = '-' } = options;

  let slug = title
    .toLowerCase()
    .trim()
    // Replace accented characters
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    // Convert to basic latin characters
    .replace(/[^\w\s-]/g, '')
    // Replace multiple spaces/separators with single space
    .replace(/[\s_-]+/g, ' ');

  // Remove stop words if enabled
  if (removeStopWords) {
    slug = slug
      .split(' ')
      .filter((word) => word.length > 0 && !STOP_WORDS.has(word))
      .join(' ');
  }

  // Convert spaces to separators and clean up
  slug = slug
    .replace(/\s+/g, separator)
    .replace(new RegExp(`\\${separator}+`, 'g'), separator)
    .replace(new RegExp(`^\\${separator}+|\\${separator}+$`, 'g'), '');

  // Truncate if too long, but avoid cutting words
  if (slug.length > maxLength) {
    const truncated = slug.substring(0, maxLength);
    const lastSeparator = truncated.lastIndexOf(separator);
    slug = lastSeparator > maxLength * 0.7 ? truncated.substring(0, lastSeparator) : truncated;
  }

  return slug || '';
};
