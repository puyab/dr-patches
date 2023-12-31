import createMiddleware from "next-intl/middleware";

export const locales = [
  { code: "en", label: "English", flag: "gb" },
  { code: "ara", label: "Arabic", flag: "sa" },
  { code: "chi", label: "Chinese", flag: "cn" },
  { code: "deu", label: "German", flag: "de" },
  { code: "es", label: "Spanish", flag: "es" },
  { code: "fr", label: "French", flag: "fr" },
  { code: "it", label: "Italian", flag: "it" },
  { code: "por", label: "Portuguese", flag: "pt" },
  { code: "rus", label: "Russian", flag: "ru" },
];

const localesCode = locales.map((locale) => locale.code);

export const LanguageMiddleware = {
  middleware: createMiddleware({
    locales: localesCode,
    defaultLocale: "en",
  }),
  matcher: /\/((?!api|_next|.*\\..*).*)/,
};
