type ParamValue =
  | string
  | number
  | boolean
  | null
  | undefined
  | ParamValue[]
  | { [key: string]: ParamValue };

export const clearParamKey = <T extends Record<string, ParamValue>>(params: T): Partial<T> => {
  const obj = { ...params };

  (Object.keys(obj) as Array<keyof T>).forEach((key) => {
    const val = obj[key];
    if (
      val == null ||
      (typeof val === 'string' && val.trim() === '') ||
      (Array.isArray(val) && val.length === 0) ||
      (typeof val === 'object' &&
        !Array.isArray(val) &&
        val !== null &&
        Object.keys(val).length === 0)
    ) {
      delete obj[key];
    }
  });

  return obj;
};
