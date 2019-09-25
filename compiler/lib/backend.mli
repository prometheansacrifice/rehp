type t =
  | Php
  | Js
  | Wasm

val to_string : t -> string

val from_string : string -> t

val extension : t -> string
