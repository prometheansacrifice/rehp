type t =
  | Php
  | Js
  | Wasm

let to_string t =
  match t with
  | Php -> "php"
  | Js -> "js"
  | Wasm -> "wasm"

let from_string = function
  | "php" -> Php
  | "js" -> Js
  | "wasm" -> Wasm
  | _ as s -> raise (Invalid_argument (s ^ " is not a valid backend"))

let extension = to_string
