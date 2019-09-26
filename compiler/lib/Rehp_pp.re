open Rehp;

let rec pp = ff =>
  fun
  | ERaw(s) => Format.fprintf(ff, "(eraw \"%s\")", s)
  | _ => Format.fprintf(ff, "TODO");

/* | Atom(a) => Format.fprintf(ff, "%d", a) */
/* | List(l) => { */
/*     let formatBody = */
/*       Format.pp_print_list(pp, ~pp_sep=(ff, _) => */
/*         Format.fprintf(ff, "@;") */
/*       ); */
/*     Format.fprintf(ff, "@[<hv 4>(%a)@]", formatBody, l); */
/*   }; */
