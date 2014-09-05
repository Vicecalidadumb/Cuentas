/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES
 */
 
jQuery.extend(jQuery.validator.messages, {
  required: "Este campo es obligatorio.",
  remote: "Por favor, rellene este campo.",
  email: "Por favor, escriba una direccion de correo valida",
  url: "Por favor, escriba una URL valida.",
  date: "Por favor, escriba una fecha valida.",
  dateISO: "Por favor, escriba una fecha (ISO) valida.",
  number: "Por favor, escriba un numero entero valido.",
  digits: "Por favor, escriba solo digitos.",
  creditcard: "Por favor, escriba un numero de tarjeta valido.",
  equalTo: "Por favor, escriba el mismo valor de nuevo.",
  accept: "Por favor, escriba un valor con una extension aceptada.",
  maxlength: jQuery.validator.format("Por favor, no escriba mas de {0} caracteres."),
  minlength: jQuery.validator.format("Por favor, no escriba menos de {0} caracteres."),
  rangelength: jQuery.validator.format("Por favor, escriba un valor entre {0} y {1} caracteres."),
  range: jQuery.validator.format("Por favor, escriba un valor entre {0} y {1}."),
  max: jQuery.validator.format("Por favor, escriba un valor menor o igual a {0}."),
  min: jQuery.validator.format("Por favor, escriba un valor mayor o igual a {0}.")
});