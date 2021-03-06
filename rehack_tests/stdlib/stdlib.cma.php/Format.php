<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Format.php
 */

namespace Rehack;

final class Format {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Buffer = Buffer::get();
    $CamlinternalFormat = CamlinternalFormat::get();
    $List_ = List_::get();
    $Pervasives = Pervasives::get();
    $String_ = String_::get();
    $Not_found = Not_found::get();
    Format::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Format;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $output_acc = new Ref();$strput_acc = new Ref();
    $runtime = $joo_global_object->jsoo_runtime;
    $call1 = $runtime["caml_call1"];
    $call2 = $runtime["caml_call2"];
    $call3 = $runtime["caml_call3"];
    $call4 = $runtime["caml_call4"];
    $caml_ml_string_length = $runtime["caml_ml_string_length"];
    $string = $runtime["caml_new_string"];
    $caml_wrap_exception = $runtime["caml_wrap_exception"];
    $is_int = $runtime["is_int"];
    $global_data = $runtime["caml_get_global_data"]();
    $cst__4 = $string(".");
    $cst__2 = $string(">");
    $cst__3 = $string("</");
    $cst__0 = $string(">");
    $cst__1 = $string("<");
    $cst = $string("\n");
    $cst_Format_Empty_queue = $string("Format.Empty_queue");
    $CamlinternalFormat = $global_data["CamlinternalFormat"];
    $Pervasives = $global_data["Pervasives"];
    $String = $global_data["String_"];
    $Buffer = $global_data["Buffer"];
    $List = $global_data["List_"];
    $Not_found = $global_data["Not_found"];
    $sH = Vector{3, 0, 3};
    $sG = Vector{0, $string("")};
    $make_queue = function(dynamic $param) {return Vector{0, 0, 0};};
    $clear_queue = function(dynamic $q) {$q[1] = 0;$q[2] = 0;return 0;};
    $add_queue = function(dynamic $x, dynamic $q) {
      $c = Vector{0, $x, 0};
      $vS = $q[1];
      if ($vS) {$q[1] = $c;$vS[2] = $c;return 0;}
      $q[1] = $c;
      $q[2] = $c;
      return 0;
    };
    $Empty_queue = Vector{
      248,
      $cst_Format_Empty_queue,
      $runtime["caml_fresh_oo_id"](0)
    };
    $peek_queue = function(dynamic $param) use ($Empty_queue,$runtime) {
      $vR = $param[2];
      if ($vR) {$x = $vR[1];return $x;}
      throw $runtime["caml_wrap_thrown_exception"]($Empty_queue) as \Throwable;
    };
    $take_queue = function(dynamic $q) use ($Empty_queue,$runtime) {
      $vQ = $q[2];
      if ($vQ) {
        $x = $vQ[1];
        $tl = $vQ[2];
        $q[2] = $tl;
        if (0 === $tl) {$q[1] = 0;}
        return $x;
      }
      throw $runtime["caml_wrap_thrown_exception"]($Empty_queue) as \Throwable;
    };
    $pp_enqueue = function(dynamic $state, dynamic $token) use ($add_queue) {
      $len = $token[3];
      $state[13] = (int) ($state[13] + $len);
      return $add_queue($token, $state[28]);
    };
    $pp_clear_queue = function(dynamic $state) use ($clear_queue) {
      $state[12] = 1;
      $state[13] = 1;
      return $clear_queue($state[28]);
    };
    $pp_infinity = 1000000010;
    $pp_output_string = function(dynamic $state, dynamic $s) use ($call3,$caml_ml_string_length) {
      return $call3($state[17], $s, 0, $caml_ml_string_length($s));
    };
    $pp_output_newline = function(dynamic $state) use ($call1) {
      return $call1($state[19], 0);
    };
    $pp_output_spaces = function(dynamic $state, dynamic $n) use ($call1) {
      return $call1($state[20], $n);
    };
    $pp_output_indent = function(dynamic $state, dynamic $n) use ($call1) {
      return $call1($state[21], $n);
    };
    $break_new_line = function
    (dynamic $state, dynamic $offset, dynamic $width) use ($Pervasives,$call2,$pp_output_indent,$pp_output_newline) {
      $pp_output_newline($state);
      $state[11] = 1;
      $indent = (int) ((int) ($state[6] - $width) + $offset);
      $real_indent = $call2($Pervasives[4], $state[8], $indent);
      $state[10] = $real_indent;
      $state[9] = (int) ($state[6] - $state[10]);
      return $pp_output_indent($state, $state[10]);
    };
    $break_line = function(dynamic $state, dynamic $width) use ($break_new_line) {
      return $break_new_line($state, 0, $width);
    };
    $break_same_line = function(dynamic $state, dynamic $width) use ($pp_output_spaces) {
      $state[9] = (int) ($state[9] - $width);
      return $pp_output_spaces($state, $width);
    };
    $pp_force_break_line = function(dynamic $state) use ($break_line,$pp_output_newline) {
      $vN = $state[2];
      if ($vN) {
        $match = $vN[1];
        $width = $match[2];
        $bl_ty = $match[1];
        $vO = $state[9] < $width ? 1 : (0);
        if ($vO) {
          if (0 !== $bl_ty) {
            return 5 <= $bl_ty ? 0 : ($break_line($state, $width));
          }
          $vP = 0;
        }
        else {$vP = $vO;}
        return $vP;
      }
      return $pp_output_newline($state);
    };
    $pp_skip_token = function(dynamic $state) use ($take_queue) {
      $match = $take_queue($state[28]);
      $size = $match[1];
      $len = $match[3];
      $state[12] = (int) ($state[12] - $len);
      $state[9] = (int) ($state[9] + $size);
      return 0;
    };
    $format_pp_token = function(dynamic $state, dynamic $size, dynamic $param) use ($Not_found,$add_tab,$break_line,$break_new_line,$break_same_line,$call1,$caml_wrap_exception,$is_int,$pp_force_break_line,$pp_output_newline,$pp_output_string,$pp_skip_token,$runtime) {
      if ($is_int($param)) {
        switch($param) {
          // FALLTHROUGH
          case 0:
            $vC = $state[3];
            if ($vC) {
              $match = $vC[1];
              $tabs = $match[1];
              $add_tab->contents = function(dynamic $n, dynamic $ls) use ($add_tab,$runtime) {
                if ($ls) {
                  $l = $ls[2];
                  $x = $ls[1];
                  return $runtime["caml_lessthan"]($n, $x)
                    ? Vector{0, $n, $ls}
                    : (Vector{0, $x, $add_tab->contents($n, $l)});
                }
                return Vector{0, $n, 0};
              };
              $tabs[1] =
                $add_tab->contents((int) ($state[6] - $state[9]), $tabs[1]);
              return 0;
            }
            return 0;
          // FALLTHROUGH
          case 1:
            $vD = $state[2];
            if ($vD) {$ls = $vD[2];$state[2] = $ls;return 0;}
            return 0;
          // FALLTHROUGH
          case 2:
            $vE = $state[3];
            if ($vE) {$ls__0 = $vE[2];$state[3] = $ls__0;return 0;}
            return 0;
          // FALLTHROUGH
          case 3:
            $vF = $state[2];
            if ($vF) {
              $match__0 = $vF[1];
              $width = $match__0[2];
              return $break_line($state, $width);
            }
            return $pp_output_newline($state);
          // FALLTHROUGH
          case 4:
            $vG = $state[10] !== (int) ($state[6] - $state[9]) ? 1 : (0);
            return $vG ? $pp_skip_token($state) : ($vG);
          // FALLTHROUGH
          default:
            $vH = $state[5];
            if ($vH) {
              $tags = $vH[2];
              $tag_name = $vH[1];
              $marker = $call1($state[25], $tag_name);
              $pp_output_string($state, $marker);
              $state[5] = $tags;
              return 0;
            }
            return 0;
          }
      }
      else {
        switch($param[0]) {
          // FALLTHROUGH
          case 0:
            $s = $param[1];
            $state[9] = (int) ($state[9] - $size);
            $pp_output_string($state, $s);
            $state[11] = 0;
            return 0;
          // FALLTHROUGH
          case 1:
            $off = $param[2];
            $n = $param[1];
            $vI = $state[2];
            if ($vI) {
              $match__1 = $vI[1];
              $width__0 = $match__1[2];
              $ty = $match__1[1];
              switch($ty) {
                // FALLTHROUGH
                case 0:
                  return $break_same_line($state, $n);
                // FALLTHROUGH
                case 1:
                  return $break_new_line($state, $off, $width__0);
                // FALLTHROUGH
                case 2:
                  return $break_new_line($state, $off, $width__0);
                // FALLTHROUGH
                case 3:
                  return $state[9] < $size
                    ? $break_new_line($state, $off, $width__0)
                    : ($break_same_line($state, $n));
                // FALLTHROUGH
                case 4:
                  return $state[11]
                    ? $break_same_line($state, $n)
                    : ($state[9] < $size
                     ? $break_new_line($state, $off, $width__0)
                     : ((int)
                     ((int) ($state[6] - $width__0) + $off) < $state[10]
                      ? $break_new_line($state, $off, $width__0)
                      : ($break_same_line($state, $n))));
                // FALLTHROUGH
                default:
                  return $break_same_line($state, $n);
                }
            }
            return 0;
          // FALLTHROUGH
          case 2:
            $off__0 = $param[2];
            $n__0 = $param[1];
            $insertion_point = (int) ($state[6] - $state[9]);
            $vJ = $state[3];
            if ($vJ) {
              $match__2 = $vJ[1];
              $tabs__0 = $match__2[1];
              $find = function(dynamic $n, dynamic $param) use ($Not_found,$runtime) {
                $param__0 = $param;
                for (;;) {
                  if ($param__0) {
                    $l = $param__0[2];
                    $x = $param__0[1];
                    if ($runtime["caml_greaterequal"]($x, $n)) {return $x;}
                    $param__0 = $l;
                    continue;
                  }
                  throw $runtime["caml_wrap_thrown_exception"]($Not_found) as \Throwable;
                }
              };
              $vK = $tabs__0[1];
              if ($vK) {
                $x = $vK[1];
                try {$vL = $find($insertion_point, $tabs__0[1]);$x__0 = $vL;}
                catch(\Throwable $vM) {
                  $vM = $caml_wrap_exception($vM);
                  if ($vM !== $Not_found) {
                    throw $runtime["caml_wrap_thrown_exception_reraise"]($vM) as \Throwable;
                  }
                  $x__0 = $x;
                }
                $tab = $x__0;
              }
              else {$tab = $insertion_point;}
              $offset = (int) ($tab - $insertion_point);
              return 0 <= $offset
                ? $break_same_line($state, (int) ($offset + $n__0))
                : ($break_new_line($state, (int) ($tab + $off__0), $state[6]));
            }
            return 0;
          // FALLTHROUGH
          case 3:
            $ty__0 = $param[2];
            $off__1 = $param[1];
            $insertion_point__0 = (int) ($state[6] - $state[9]);
            if ($state[8] < $insertion_point__0) {$pp_force_break_line($state);}
            $offset__0 = (int) ($state[9] - $off__1);
            $bl_type = 1 === $ty__0 ? 1 : ($state[9] < $size ? $ty__0 : (5));
            $state[2] = Vector{0, Vector{0, $bl_type, $offset__0}, $state[2]};
            return 0;
          // FALLTHROUGH
          case 4:
            $tbox = $param[1];
            $state[3] = Vector{0, $tbox, $state[3]};
            return 0;
          // FALLTHROUGH
          default:
            $tag_name__0 = $param[1];
            $marker__0 = $call1($state[24], $tag_name__0);
            $pp_output_string($state, $marker__0);
            $state[5] = Vector{0, $tag_name__0, $state[5]};
            return 0;
          }
      }
    };
    $advance_loop = function(dynamic $state) use ($format_pp_token,$peek_queue,$pp_infinity,$take_queue) {
      for (;;) {
        $match = $peek_queue($state[28]);
        $size = $match[1];
        $len = $match[3];
        $tok = $match[2];
        $vz = $size < 0 ? 1 : (0);
        $vA = $vz
          ? (int) ($state[13] - $state[12]) < $state[9] ? 1 : (0)
          : ($vz);
        $vB = 1 - $vA;
        if ($vB) {
          $take_queue($state[28]);
          $size__0 = 0 <= $size ? $size : ($pp_infinity);
          $format_pp_token($state, $size__0, $tok);
          $state[12] = (int) ($len + $state[12]);
          continue;
        }
        return $vB;
      }
    };
    $advance_left = function(dynamic $state) use ($Empty_queue,$advance_loop,$caml_wrap_exception,$runtime) {
      try {$vx = $advance_loop($state);return $vx;}
      catch(\Throwable $vy) {
        $vy = $caml_wrap_exception($vy);
        if ($vy === $Empty_queue) {return 0;}
        throw $runtime["caml_wrap_thrown_exception_reraise"]($vy) as \Throwable;
      }
    };
    $enqueue_advance = function(dynamic $state, dynamic $tok) use ($advance_left,$pp_enqueue) {
      $pp_enqueue($state, $tok);
      return $advance_left($state);
    };
    $make_queue_elem = function(dynamic $size, dynamic $tok, dynamic $len) {return Vector{0, $size, $tok, $len};
    };
    $enqueue_string_as = function(dynamic $state, dynamic $size, dynamic $s) use ($enqueue_advance,$make_queue_elem) {
      return $enqueue_advance(
        $state,
        $make_queue_elem($size, Vector{0, $s}, $size)
      );
    };
    $enqueue_string = function(dynamic $state, dynamic $s) use ($caml_ml_string_length,$enqueue_string_as) {
      $len = $caml_ml_string_length($s);
      return $enqueue_string_as($state, $len, $s);
    };
    $q_elem = $make_queue_elem(-1, $sG, 0);
    $scan_stack_bottom = Vector{0, Vector{0, -1, $q_elem}, 0};
    $clear_scan_stack = function(dynamic $state) use ($scan_stack_bottom) {
      $state[1] = $scan_stack_bottom;
      return 0;
    };
    $set_size = function(dynamic $state, dynamic $ty) use ($clear_scan_stack,$is_int) {
      $vt = $state[1];
      if ($vt) {
        $match = $vt[1];
        $queue_elem = $match[2];
        $left_tot = $match[1];
        $size = $queue_elem[1];
        $t = $vt[2];
        $tok = $queue_elem[2];
        if ($left_tot < $state[12]) {return $clear_scan_stack($state);}
        if (! $is_int($tok)) {
          switch($tok[0]) {
            // FALLTHROUGH
            case 3:
              $vv = 1 - $ty;
              if ($vv) {
                $queue_elem[1] = (int) ($state[13] + $size);
                $state[1] = $t;
                $vw = 0;
              }
              else {$vw = $vv;}
              return $vw;
            // FALLTHROUGH
            case 1:
            // FALLTHROUGH
            case 2:
              if ($ty) {
                $queue_elem[1] = (int) ($state[13] + $size);
                $state[1] = $t;
                $vu = 0;
              }
              else {$vu = $ty;}
              return $vu;
            }
        }
        return 0;
      }
      return 0;
    };
    $scan_push = function(dynamic $state, dynamic $b, dynamic $tok) use ($pp_enqueue,$set_size) {
      $pp_enqueue($state, $tok);
      if ($b) {$set_size($state, 1);}
      $state[1] = Vector{0, Vector{0, $state[13], $tok}, $state[1]};
      return 0;
    };
    $pp_open_box_gen = function
    (dynamic $state, dynamic $indent, dynamic $br_ty) use ($enqueue_string,$make_queue_elem,$scan_push) {
      $state[14] = (int) ($state[14] + 1);
      if ($state[14] < $state[15]) {
        $elem = $make_queue_elem(
          (int)
          -
          $state[13],
          Vector{3, $indent, $br_ty},
          0
        );
        return $scan_push($state, 0, $elem);
      }
      $vs = $state[14] === $state[15] ? 1 : (0);
      return $vs ? $enqueue_string($state, $state[16]) : ($vs);
    };
    $pp_open_sys_box = function(dynamic $state) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, 0, 3);
    };
    $pp_close_box = function(dynamic $state, dynamic $param) use ($pp_enqueue,$set_size) {
      $vq = 1 < $state[14] ? 1 : (0);
      if ($vq) {
        if ($state[14] < $state[15]) {
          $pp_enqueue($state, Vector{0, 0, 1, 0});
          $set_size($state, 1);
          $set_size($state, 0);
        }
        $state[14] = (int) ($state[14] + -1);
        $vr = 0;
      }
      else {$vr = $vq;}
      return $vr;
    };
    $pp_open_tag = function(dynamic $state, dynamic $tag_name) use ($call1,$pp_enqueue) {
      if ($state[22]) {
        $state[4] = Vector{0, $tag_name, $state[4]};
        $call1($state[26], $tag_name);
      }
      $vp = $state[23];
      return $vp
        ? $pp_enqueue($state, Vector{0, 0, Vector{5, $tag_name}, 0})
        : ($vp);
    };
    $pp_close_tag = function(dynamic $state, dynamic $param) use ($call1,$pp_enqueue) {
      if ($state[23]) {$pp_enqueue($state, Vector{0, 0, 5, 0});}
      $vm = $state[22];
      if ($vm) {
        $vn = $state[4];
        if ($vn) {
          $tags = $vn[2];
          $tag_name = $vn[1];
          $call1($state[27], $tag_name);
          $state[4] = $tags;
          return 0;
        }
        $vo = 0;
      }
      else {$vo = $vm;}
      return $vo;
    };
    $pp_set_print_tags = function(dynamic $state, dynamic $b) {$state[22] = $b;return 0;
    };
    $pp_set_mark_tags = function(dynamic $state, dynamic $b) {$state[23] = $b;return 0;
    };
    $pp_get_print_tags = function(dynamic $state, dynamic $param) {return $state[22];
    };
    $pp_get_mark_tags = function(dynamic $state, dynamic $param) {return $state[23];
    };
    $pp_set_tags = function(dynamic $state, dynamic $b) use ($pp_set_mark_tags,$pp_set_print_tags) {
      $pp_set_print_tags($state, $b);
      return $pp_set_mark_tags($state, $b);
    };
    $pp_get_formatter_tag_functions = function(dynamic $state, dynamic $param) {
      return Vector{0, $state[24], $state[25], $state[26], $state[27]};
    };
    $pp_set_formatter_tag_functions = function(dynamic $state, dynamic $param) {
      $pct = $param[4];
      $pot = $param[3];
      $mct = $param[2];
      $mot = $param[1];
      $state[24] = $mot;
      $state[25] = $mct;
      $state[26] = $pot;
      $state[27] = $pct;
      return 0;
    };
    $pp_rinit = function(dynamic $state) use ($clear_scan_stack,$pp_clear_queue,$pp_open_sys_box) {
      $pp_clear_queue($state);
      $clear_scan_stack($state);
      $state[2] = 0;
      $state[3] = 0;
      $state[4] = 0;
      $state[5] = 0;
      $state[10] = 0;
      $state[14] = 0;
      $state[9] = $state[6];
      return $pp_open_sys_box($state);
    };
    $clear_tag_stack = function(dynamic $state) use ($List,$call2,$pp_close_tag) {
      $vk = $state[4];
      $vl = function(dynamic $param) use ($pp_close_tag,$state) {
        return $pp_close_tag($state, 0);
      };
      return $call2($List[15], $vl, $vk);
    };
    $pp_flush_queue = function(dynamic $state, dynamic $b) use ($advance_left,$clear_tag_stack,$pp_close_box,$pp_infinity,$pp_output_newline,$pp_rinit) {
      $clear_tag_stack($state);
      for (;;) {
        if (1 < $state[14]) {$pp_close_box($state, 0);continue;}
        $state[13] = $pp_infinity;
        $advance_left($state);
        if ($b) {$pp_output_newline($state);}
        return $pp_rinit($state);
      }
    };
    $pp_print_as_size = function(dynamic $state, dynamic $size, dynamic $s) use ($enqueue_string_as) {
      $vj = $state[14] < $state[15] ? 1 : (0);
      return $vj ? $enqueue_string_as($state, $size, $s) : ($vj);
    };
    $pp_print_as = function(dynamic $state, dynamic $isize, dynamic $s) use ($pp_print_as_size) {
      return $pp_print_as_size($state, $isize, $s);
    };
    $pp_print_string = function(dynamic $state, dynamic $s) use ($caml_ml_string_length,$pp_print_as) {
      return $pp_print_as($state, $caml_ml_string_length($s), $s);
    };
    $pp_print_int = function(dynamic $state, dynamic $i) use ($Pervasives,$call1,$pp_print_string) {
      return $pp_print_string($state, $call1($Pervasives[21], $i));
    };
    $pp_print_float = function(dynamic $state, dynamic $f) use ($Pervasives,$call1,$pp_print_string) {
      return $pp_print_string($state, $call1($Pervasives[23], $f));
    };
    $pp_print_bool = function(dynamic $state, dynamic $b) use ($Pervasives,$call1,$pp_print_string) {
      return $pp_print_string($state, $call1($Pervasives[18], $b));
    };
    $pp_print_char = function(dynamic $state, dynamic $c) use ($String,$call2,$pp_print_as) {
      return $pp_print_as($state, 1, $call2($String[1], 1, $c));
    };
    $pp_open_hbox = function(dynamic $state, dynamic $param) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, 0, 0);
    };
    $pp_open_vbox = function(dynamic $state, dynamic $indent) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, $indent, 1);
    };
    $pp_open_hvbox = function(dynamic $state, dynamic $indent) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, $indent, 2);
    };
    $pp_open_hovbox = function(dynamic $state, dynamic $indent) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, $indent, 3);
    };
    $pp_open_box = function(dynamic $state, dynamic $indent) use ($pp_open_box_gen) {
      return $pp_open_box_gen($state, $indent, 4);
    };
    $pp_print_newline = function(dynamic $state, dynamic $param) use ($call1,$pp_flush_queue) {
      $pp_flush_queue($state, 1);
      return $call1($state[18], 0);
    };
    $pp_print_flush = function(dynamic $state, dynamic $param) use ($call1,$pp_flush_queue) {
      $pp_flush_queue($state, 0);
      return $call1($state[18], 0);
    };
    $pp_force_newline = function(dynamic $state, dynamic $param) use ($enqueue_advance,$make_queue_elem) {
      $vi = $state[14] < $state[15] ? 1 : (0);
      return $vi ? $enqueue_advance($state, $make_queue_elem(0, 3, 0)) : ($vi);
    };
    $pp_print_if_newline = function(dynamic $state, dynamic $param) use ($enqueue_advance,$make_queue_elem) {
      $vh = $state[14] < $state[15] ? 1 : (0);
      return $vh ? $enqueue_advance($state, $make_queue_elem(0, 4, 0)) : ($vh);
    };
    $pp_print_break = function
    (dynamic $state, dynamic $width, dynamic $offset) use ($make_queue_elem,$scan_push) {
      $vg = $state[14] < $state[15] ? 1 : (0);
      if ($vg) {
        $elem = $make_queue_elem(
          (int)
          -
          $state[13],
          Vector{1, $width, $offset},
          $width
        );
        return $scan_push($state, 1, $elem);
      }
      return $vg;
    };
    $pp_print_space = function(dynamic $state, dynamic $param) use ($pp_print_break) {
      return $pp_print_break($state, 1, 0);
    };
    $pp_print_cut = function(dynamic $state, dynamic $param) use ($pp_print_break) {
      return $pp_print_break($state, 0, 0);
    };
    $pp_open_tbox = function(dynamic $state, dynamic $param) use ($enqueue_advance,$make_queue_elem) {
      $state[14] = (int) ($state[14] + 1);
      $vf = $state[14] < $state[15] ? 1 : (0);
      if ($vf) {
        $elem = $make_queue_elem(0, Vector{4, Vector{0, Vector{0, 0}}}, 0);
        return $enqueue_advance($state, $elem);
      }
      return $vf;
    };
    $pp_close_tbox = function(dynamic $state, dynamic $param) use ($enqueue_advance,$make_queue_elem) {
      $vc = 1 < $state[14] ? 1 : (0);
      if ($vc) {
        $vd = $state[14] < $state[15] ? 1 : (0);
        if ($vd) {
          $elem = $make_queue_elem(0, 2, 0);
          $enqueue_advance($state, $elem);
          $state[14] = (int) ($state[14] + -1);
          $ve = 0;
        }
        else {$ve = $vd;}
      }
      else {$ve = $vc;}
      return $ve;
    };
    $pp_print_tbreak = function
    (dynamic $state, dynamic $width, dynamic $offset) use ($make_queue_elem,$scan_push) {
      $vb = $state[14] < $state[15] ? 1 : (0);
      if ($vb) {
        $elem = $make_queue_elem(
          (int)
          -
          $state[13],
          Vector{2, $width, $offset},
          $width
        );
        return $scan_push($state, 1, $elem);
      }
      return $vb;
    };
    $pp_print_tab = function(dynamic $state, dynamic $param) use ($pp_print_tbreak) {
      return $pp_print_tbreak($state, 0, 0);
    };
    $pp_set_tab = function(dynamic $state, dynamic $param) use ($enqueue_advance,$make_queue_elem) {
      $va = $state[14] < $state[15] ? 1 : (0);
      if ($va) {
        $elem = $make_queue_elem(0, 0, 0);
        return $enqueue_advance($state, $elem);
      }
      return $va;
    };
    $pp_set_max_boxes = function(dynamic $state, dynamic $n) {
      $u9 = 1 < $n ? 1 : (0);
      if ($u9) {
        $state[15] = $n;
        $u_ = 0;
      }
      else {$u_ = $u9;}
      return $u_;
    };
    $pp_get_max_boxes = function(dynamic $state, dynamic $param) {return $state[15];
    };
    $pp_over_max_boxes = function(dynamic $state, dynamic $param) {
      return $state[14] === $state[15] ? 1 : (0);
    };
    $pp_set_ellipsis_text = function(dynamic $state, dynamic $s) {$state[16] = $s;return 0;
    };
    $pp_get_ellipsis_text = function(dynamic $state, dynamic $param) {return $state[16];
    };
    $pp_limit = function(dynamic $n) {
      return $n < 1000000010 ? $n : (1000000009);
    };
    $pp_set_min_space_left = function(dynamic $state, dynamic $n) use ($pp_limit,$pp_rinit) {
      $u8 = 1 <= $n ? 1 : (0);
      if ($u8) {
        $n__0 = $pp_limit($n);
        $state[7] = $n__0;
        $state[8] = (int) ($state[6] - $state[7]);
        return $pp_rinit($state);
      }
      return $u8;
    };
    $pp_set_max_indent = function(dynamic $state, dynamic $n) use ($pp_set_min_space_left) {
      return $pp_set_min_space_left($state, (int) ($state[6] - $n));
    };
    $pp_get_max_indent = function(dynamic $state, dynamic $param) {return $state[8];
    };
    $pp_set_margin = function(dynamic $state, dynamic $n) use ($Pervasives,$call2,$pp_limit,$pp_set_max_indent) {
      $u6 = 1 <= $n ? 1 : (0);
      if ($u6) {
        $n__0 = $pp_limit($n);
        $state[6] = $n__0;
        if ($state[8] <= $state[6]) {
          $new_max_indent = $state[8];
        }
        else {
          $u7 = $call2(
            $Pervasives[5],
            (int)
            ($state[6] - $state[7]),
            (int)
            ($state[6] / 2)
          );
          $new_max_indent = $call2($Pervasives[5], $u7, 1);
        }
        return $pp_set_max_indent($state, $new_max_indent);
      }
      return $u6;
    };
    $pp_get_margin = function(dynamic $state, dynamic $param) {return $state[6];
    };
    $pp_set_formatter_out_functions = function(dynamic $state, dynamic $param) {
      $j = $param[5];
      $i = $param[4];
      $h = $param[3];
      $g = $param[2];
      $f = $param[1];
      $state[17] = $f;
      $state[18] = $g;
      $state[19] = $h;
      $state[20] = $i;
      $state[21] = $j;
      return 0;
    };
    $pp_get_formatter_out_functions = function(dynamic $state, dynamic $param) {
      return Vector{
        0,
        $state[17],
        $state[18],
        $state[19],
        $state[20],
        $state[21]
      };
    };
    $pp_set_formatter_output_functions = function
    (dynamic $state, dynamic $f, dynamic $g) {
      $state[17] = $f;
      $state[18] = $g;
      return 0;
    };
    $pp_get_formatter_output_functions = function
    (dynamic $state, dynamic $param) {
      return Vector{0, $state[17], $state[18]};
    };
    $display_newline = function(dynamic $state, dynamic $param) use ($call3,$cst) {
      return $call3($state[17], $cst, 0, 1);
    };
    $blank_line = $call2($String[1], 80, 32);
    $display_blanks = function(dynamic $state, dynamic $n) use ($blank_line,$call3) {
      $n__0 = $n;
      for (;;) {
        $u5 = 0 < $n__0 ? 1 : (0);
        if ($u5) {
          if (80 < $n__0) {
            $call3($state[17], $blank_line, 0, 80);
            $n__1 = (int) ($n__0 + -80);
            $n__0 = $n__1;
            continue;
          }
          return $call3($state[17], $blank_line, 0, $n__0);
        }
        return $u5;
      }
    };
    $pp_set_formatter_out_channel = function(dynamic $state, dynamic $oc) use ($Pervasives,$call1,$display_blanks,$display_newline) {
      $state[17] = $call1($Pervasives[57], $oc);
      $state[18] =
        function(dynamic $param) use ($Pervasives,$call1,$oc) {
          return $call1($Pervasives[51], $oc);
        };
      $state[19] =
        function(dynamic $u4) use ($display_newline,$state) {
          return $display_newline($state, $u4);
        };
      $state[20] =
        function(dynamic $u3) use ($display_blanks,$state) {
          return $display_blanks($state, $u3);
        };
      $state[21] =
        function(dynamic $u2) use ($display_blanks,$state) {
          return $display_blanks($state, $u2);
        };
      return 0;
    };
    $default_pp_mark_open_tag = function(dynamic $s) use ($Pervasives,$call2,$cst__0,$cst__1) {
      $u1 = $call2($Pervasives[16], $s, $cst__0);
      return $call2($Pervasives[16], $cst__1, $u1);
    };
    $default_pp_mark_close_tag = function(dynamic $s) use ($Pervasives,$call2,$cst__2,$cst__3) {
      $u0 = $call2($Pervasives[16], $s, $cst__2);
      return $call2($Pervasives[16], $cst__3, $u0);
    };
    $default_pp_print_open_tag = function(dynamic $uZ) {return 0;};
    $default_pp_print_close_tag = function(dynamic $uY) {return 0;};
    $pp_make_formatter = function
    (dynamic $f, dynamic $g, dynamic $h, dynamic $i, dynamic $j) use ($Pervasives,$add_queue,$cst__4,$default_pp_mark_close_tag,$default_pp_mark_open_tag,$default_pp_print_close_tag,$default_pp_print_open_tag,$make_queue,$make_queue_elem,$sH,$scan_stack_bottom) {
      $pp_queue = $make_queue(0);
      $sys_tok = $make_queue_elem(-1, $sH, 0);
      $add_queue($sys_tok, $pp_queue);
      $sys_scan_stack = Vector{0, Vector{0, 1, $sys_tok}, $scan_stack_bottom};
      return Vector{
        0,
        $sys_scan_stack,
        0,
        0,
        0,
        0,
        78,
        10,
        68,
        78,
        0,
        1,
        1,
        1,
        1,
        $Pervasives[7],
        $cst__4,
        $f,
        $g,
        $h,
        $i,
        $j,
        0,
        0,
        $default_pp_mark_open_tag,
        $default_pp_mark_close_tag,
        $default_pp_print_open_tag,
        $default_pp_print_close_tag,
        $pp_queue
      };
    };
    $formatter_of_out_functions = function(dynamic $out_funs) use ($pp_make_formatter) {
      return $pp_make_formatter(
        $out_funs[1],
        $out_funs[2],
        $out_funs[3],
        $out_funs[4],
        $out_funs[5]
      );
    };
    $make_formatter = function(dynamic $output, dynamic $flush) use ($display_blanks,$display_newline,$pp_make_formatter) {
      $uQ = function(dynamic $uX) {return 0;};
      $uR = function(dynamic $uW) {return 0;};
      $ppf = $pp_make_formatter(
        $output,
        $flush,
        function(dynamic $uV) {return 0;},
        $uR,
        $uQ
      );
      $ppf[19] =
        function(dynamic $uU) use ($display_newline,$ppf) {
          return $display_newline($ppf, $uU);
        };
      $ppf[20] =
        function(dynamic $uT) use ($display_blanks,$ppf) {
          return $display_blanks($ppf, $uT);
        };
      $ppf[21] =
        function(dynamic $uS) use ($display_blanks,$ppf) {
          return $display_blanks($ppf, $uS);
        };
      return $ppf;
    };
    $formatter_of_out_channel = function(dynamic $oc) use ($Pervasives,$call1,$make_formatter) {
      $uP = function(dynamic $param) use ($Pervasives,$call1,$oc) {
        return $call1($Pervasives[51], $oc);
      };
      return $make_formatter($call1($Pervasives[57], $oc), $uP);
    };
    $formatter_of_buffer = function(dynamic $b) use ($Buffer,$call1,$make_formatter) {
      $uN = function(dynamic $uO) {return 0;};
      return $make_formatter($call1($Buffer[16], $b), $uN);
    };
    $pp_buffer_size = 512;
    $pp_make_buffer = function(dynamic $param) use ($Buffer,$call1,$pp_buffer_size) {
      return $call1($Buffer[1], $pp_buffer_size);
    };
    $stdbuf = $pp_make_buffer(0);
    $std_formatter = $formatter_of_out_channel($Pervasives[27]);
    $err_formatter = $formatter_of_out_channel($Pervasives[28]);
    $str_formatter = $formatter_of_buffer($stdbuf);
    $flush_buffer_formatter = function(dynamic $buf, dynamic $ppf) use ($Buffer,$call1,$pp_flush_queue) {
      $pp_flush_queue($ppf, 0);
      $s = $call1($Buffer[2], $buf);
      $call1($Buffer[9], $buf);
      return $s;
    };
    $flush_str_formatter = function(dynamic $param) use ($flush_buffer_formatter,$stdbuf,$str_formatter) {
      return $flush_buffer_formatter($stdbuf, $str_formatter);
    };
    $make_symbolic_output_buffer = function(dynamic $param) {return Vector{0, 0};
    };
    $clear_symbolic_output_buffer = function(dynamic $sob) {
      $sob[1] = 0;
      return 0;
    };
    $get_symbolic_output_buffer = function(dynamic $sob) use ($List,$call1) {
      return $call1($List[9], $sob[1]);
    };
    $flush_symbolic_output_buffer = function(dynamic $sob) use ($clear_symbolic_output_buffer,$get_symbolic_output_buffer) {
      $items = $get_symbolic_output_buffer($sob);
      $clear_symbolic_output_buffer($sob);
      return $items;
    };
    $add_symbolic_output_item = function(dynamic $sob, dynamic $item) {
      $sob[1] = Vector{0, $item, $sob[1]};
      return 0;
    };
    $formatter_of_symbolic_output_buffer = function(dynamic $sob) use ($String,$add_symbolic_output_item,$call3,$pp_make_formatter) {
      $symbolic_flush = function(dynamic $sob, dynamic $param) use ($add_symbolic_output_item) {
        return $add_symbolic_output_item($sob, 0);
      };
      $symbolic_newline = function(dynamic $sob, dynamic $param) use ($add_symbolic_output_item) {
        return $add_symbolic_output_item($sob, 1);
      };
      $symbolic_string = function
      (dynamic $sob, dynamic $s, dynamic $i, dynamic $n) use ($String,$add_symbolic_output_item,$call3) {
        return $add_symbolic_output_item(
          $sob,
          Vector{0, $call3($String[4], $s, $i, $n)}
        );
      };
      $symbolic_spaces = function(dynamic $sob, dynamic $n) use ($add_symbolic_output_item) {
        return $add_symbolic_output_item($sob, Vector{1, $n});
      };
      $symbolic_indent = function(dynamic $sob, dynamic $n) use ($add_symbolic_output_item) {
        return $add_symbolic_output_item($sob, Vector{2, $n});
      };
      $f = function(dynamic $uK, dynamic $uL, dynamic $uM) use ($sob,$symbolic_string) {
        return $symbolic_string($sob, $uK, $uL, $uM);
      };
      $g = function(dynamic $uJ) use ($sob,$symbolic_flush) {
        return $symbolic_flush($sob, $uJ);
      };
      $h = function(dynamic $uI) use ($sob,$symbolic_newline) {
        return $symbolic_newline($sob, $uI);
      };
      $i = function(dynamic $uH) use ($sob,$symbolic_spaces) {
        return $symbolic_spaces($sob, $uH);
      };
      $j = function(dynamic $uG) use ($sob,$symbolic_indent) {
        return $symbolic_indent($sob, $uG);
      };
      return $pp_make_formatter($f, $g, $h, $i, $j);
    };
    $open_hbox = function(dynamic $uF) use ($pp_open_hbox,$std_formatter) {
      return $pp_open_hbox($std_formatter, $uF);
    };
    $open_vbox = function(dynamic $uE) use ($pp_open_vbox,$std_formatter) {
      return $pp_open_vbox($std_formatter, $uE);
    };
    $open_hvbox = function(dynamic $uD) use ($pp_open_hvbox,$std_formatter) {
      return $pp_open_hvbox($std_formatter, $uD);
    };
    $open_hovbox = function(dynamic $uC) use ($pp_open_hovbox,$std_formatter) {
      return $pp_open_hovbox($std_formatter, $uC);
    };
    $open_box = function(dynamic $uB) use ($pp_open_box,$std_formatter) {
      return $pp_open_box($std_formatter, $uB);
    };
    $close_box = function(dynamic $uA) use ($pp_close_box,$std_formatter) {
      return $pp_close_box($std_formatter, $uA);
    };
    $open_tag = function(dynamic $uz) use ($pp_open_tag,$std_formatter) {
      return $pp_open_tag($std_formatter, $uz);
    };
    $close_tag = function(dynamic $uy) use ($pp_close_tag,$std_formatter) {
      return $pp_close_tag($std_formatter, $uy);
    };
    $print_as = function(dynamic $uw, dynamic $ux) use ($pp_print_as,$std_formatter) {
      return $pp_print_as($std_formatter, $uw, $ux);
    };
    $print_string = function(dynamic $uv) use ($pp_print_string,$std_formatter) {
      return $pp_print_string($std_formatter, $uv);
    };
    $print_int = function(dynamic $uu) use ($pp_print_int,$std_formatter) {
      return $pp_print_int($std_formatter, $uu);
    };
    $print_float = function(dynamic $ut) use ($pp_print_float,$std_formatter) {
      return $pp_print_float($std_formatter, $ut);
    };
    $print_char = function(dynamic $us) use ($pp_print_char,$std_formatter) {
      return $pp_print_char($std_formatter, $us);
    };
    $print_bool = function(dynamic $ur) use ($pp_print_bool,$std_formatter) {
      return $pp_print_bool($std_formatter, $ur);
    };
    $print_break = function(dynamic $up, dynamic $uq) use ($pp_print_break,$std_formatter) {
      return $pp_print_break($std_formatter, $up, $uq);
    };
    $print_cut = function(dynamic $uo) use ($pp_print_cut,$std_formatter) {
      return $pp_print_cut($std_formatter, $uo);
    };
    $print_space = function(dynamic $un) use ($pp_print_space,$std_formatter) {
      return $pp_print_space($std_formatter, $un);
    };
    $force_newline = function(dynamic $um) use ($pp_force_newline,$std_formatter) {
      return $pp_force_newline($std_formatter, $um);
    };
    $print_flush = function(dynamic $ul) use ($pp_print_flush,$std_formatter) {
      return $pp_print_flush($std_formatter, $ul);
    };
    $print_newline = function(dynamic $uk) use ($pp_print_newline,$std_formatter) {
      return $pp_print_newline($std_formatter, $uk);
    };
    $print_if_newline = function(dynamic $uj) use ($pp_print_if_newline,$std_formatter) {
      return $pp_print_if_newline($std_formatter, $uj);
    };
    $open_tbox = function(dynamic $ui) use ($pp_open_tbox,$std_formatter) {
      return $pp_open_tbox($std_formatter, $ui);
    };
    $close_tbox = function(dynamic $uh) use ($pp_close_tbox,$std_formatter) {
      return $pp_close_tbox($std_formatter, $uh);
    };
    $print_tbreak = function(dynamic $uf, dynamic $ug) use ($pp_print_tbreak,$std_formatter) {
      return $pp_print_tbreak($std_formatter, $uf, $ug);
    };
    $set_tab = function(dynamic $ue) use ($pp_set_tab,$std_formatter) {
      return $pp_set_tab($std_formatter, $ue);
    };
    $print_tab = function(dynamic $ud) use ($pp_print_tab,$std_formatter) {
      return $pp_print_tab($std_formatter, $ud);
    };
    $set_margin = function(dynamic $uc) use ($pp_set_margin,$std_formatter) {
      return $pp_set_margin($std_formatter, $uc);
    };
    $get_margin = function(dynamic $ub) use ($pp_get_margin,$std_formatter) {
      return $pp_get_margin($std_formatter, $ub);
    };
    $set_max_indent = function(dynamic $ua) use ($pp_set_max_indent,$std_formatter) {
      return $pp_set_max_indent($std_formatter, $ua);
    };
    $get_max_indent = function(dynamic $t_) use ($pp_get_max_indent,$std_formatter) {
      return $pp_get_max_indent($std_formatter, $t_);
    };
    $set_max_boxes = function(dynamic $t9) use ($pp_set_max_boxes,$std_formatter) {
      return $pp_set_max_boxes($std_formatter, $t9);
    };
    $get_max_boxes = function(dynamic $t8) use ($pp_get_max_boxes,$std_formatter) {
      return $pp_get_max_boxes($std_formatter, $t8);
    };
    $over_max_boxes = function(dynamic $t7) use ($pp_over_max_boxes,$std_formatter) {
      return $pp_over_max_boxes($std_formatter, $t7);
    };
    $set_ellipsis_text = function(dynamic $t6) use ($pp_set_ellipsis_text,$std_formatter) {
      return $pp_set_ellipsis_text($std_formatter, $t6);
    };
    $get_ellipsis_text = function(dynamic $t5) use ($pp_get_ellipsis_text,$std_formatter) {
      return $pp_get_ellipsis_text($std_formatter, $t5);
    };
    $set_formatter_out_channel = function(dynamic $t4) use ($pp_set_formatter_out_channel,$std_formatter) {
      return $pp_set_formatter_out_channel($std_formatter, $t4);
    };
    $set_formatter_out_functions = function(dynamic $t3) use ($pp_set_formatter_out_functions,$std_formatter) {
      return $pp_set_formatter_out_functions($std_formatter, $t3);
    };
    $get_formatter_out_functions = function(dynamic $t2) use ($pp_get_formatter_out_functions,$std_formatter) {
      return $pp_get_formatter_out_functions($std_formatter, $t2);
    };
    $set_formatter_output_functions = function(dynamic $t0, dynamic $t1) use ($pp_set_formatter_output_functions,$std_formatter) {
      return $pp_set_formatter_output_functions($std_formatter, $t0, $t1);
    };
    $get_formatter_output_functions = function(dynamic $tZ) use ($pp_get_formatter_output_functions,$std_formatter) {
      return $pp_get_formatter_output_functions($std_formatter, $tZ);
    };
    $set_formatter_tag_functions = function(dynamic $tY) use ($pp_set_formatter_tag_functions,$std_formatter) {
      return $pp_set_formatter_tag_functions($std_formatter, $tY);
    };
    $get_formatter_tag_functions = function(dynamic $tX) use ($pp_get_formatter_tag_functions,$std_formatter) {
      return $pp_get_formatter_tag_functions($std_formatter, $tX);
    };
    $set_print_tags = function(dynamic $tW) use ($pp_set_print_tags,$std_formatter) {
      return $pp_set_print_tags($std_formatter, $tW);
    };
    $get_print_tags = function(dynamic $tV) use ($pp_get_print_tags,$std_formatter) {
      return $pp_get_print_tags($std_formatter, $tV);
    };
    $set_mark_tags = function(dynamic $tU) use ($pp_set_mark_tags,$std_formatter) {
      return $pp_set_mark_tags($std_formatter, $tU);
    };
    $get_mark_tags = function(dynamic $tT) use ($pp_get_mark_tags,$std_formatter) {
      return $pp_get_mark_tags($std_formatter, $tT);
    };
    $set_tags = function(dynamic $tS) use ($pp_set_tags,$std_formatter) {
      return $pp_set_tags($std_formatter, $tS);
    };
    $pp_print_list = function
    (dynamic $opt, dynamic $pp_v, dynamic $ppf, dynamic $param) use ($call2,$pp_print_cut) {
      $opt__0 = $opt;
      $param__0 = $param;
      for (;;) {
        if ($opt__0) {
          $sth = $opt__0[1];
          $pp_sep = $sth;
        }
        else {$pp_sep = $pp_print_cut;}
        if ($param__0) {
          $tQ = $param__0[2];
          $tR = $param__0[1];
          if ($tQ) {
            $call2($pp_v, $ppf, $tR);
            $call2($pp_sep, $ppf, 0);
            $opt__1 = Vector{0, $pp_sep};
            $opt__0 = $opt__1;
            $param__0 = $tQ;
            continue;
          }
          return $call2($pp_v, $ppf, $tR);
        }
        return 0;
      }
    };
    $pp_print_text = function(dynamic $ppf, dynamic $s) use ($String,$call3,$caml_ml_string_length,$pp_force_newline,$pp_print_space,$pp_print_string,$runtime) {
      $len = $caml_ml_string_length($s);
      $left = Vector{0, 0};
      $right = Vector{0, 0};
      $flush = function(dynamic $param) use ($String,$call3,$left,$pp_print_string,$ppf,$right,$s) {
        $pp_print_string(
          $ppf,
          $call3($String[4], $s, $left[1], (int) ($right[1] - $left[1]))
        );
        $right[1] += 1;
        $left[1] = $right[1];
        return 0;
      };
      for (;;) {
        if ($right[1] !== $len) {
          $match = $runtime["caml_string_get"]($s, $right[1]);
          if (10 === $match) {
            $flush(0);
            $pp_force_newline($ppf, 0);
          }
          else {
            if (32 === $match) {
              $flush(0);
              $pp_print_space($ppf, 0);
            }
            else {$right[1] += 1;}
          }
          continue;
        }
        $tP = $left[1] !== $len ? 1 : (0);
        return $tP ? $flush(0) : ($tP);
      }
    };
    $compute_tag = function(dynamic $output, dynamic $tag_acc) use ($Buffer,$call1,$call2,$call3,$formatter_of_buffer,$pp_print_flush) {
      $buf = $call1($Buffer[1], 16);
      $ppf = $formatter_of_buffer($buf);
      $call2($output, $ppf, $tag_acc);
      $pp_print_flush($ppf, 0);
      $len = $call1($Buffer[7], $buf);
      return 2 <= $len
        ? $call3($Buffer[4], $buf, 1, (int) ($len + -2))
        : ($call1($Buffer[2], $buf));
    };
    $output_formatting_lit = function(dynamic $ppf, dynamic $fmting_lit) use ($is_int,$pp_close_box,$pp_close_tag,$pp_force_newline,$pp_print_break,$pp_print_char,$pp_print_flush,$pp_print_newline) {
      if ($is_int($fmting_lit)) {
        switch($fmting_lit) {
          // FALLTHROUGH
          case 0:
            return $pp_close_box($ppf, 0);
          // FALLTHROUGH
          case 1:
            return $pp_close_tag($ppf, 0);
          // FALLTHROUGH
          case 2:
            return $pp_print_flush($ppf, 0);
          // FALLTHROUGH
          case 3:
            return $pp_force_newline($ppf, 0);
          // FALLTHROUGH
          case 4:
            return $pp_print_newline($ppf, 0);
          // FALLTHROUGH
          case 5:
            return $pp_print_char($ppf, 64);
          // FALLTHROUGH
          default:
            return $pp_print_char($ppf, 37);
          }
      }
      else {
        switch($fmting_lit[0]) {
          // FALLTHROUGH
          case 0:
            $offset = $fmting_lit[3];
            $width = $fmting_lit[2];
            return $pp_print_break($ppf, $width, $offset);
          // FALLTHROUGH
          case 1:
            return 0;
          // FALLTHROUGH
          default:
            $c = $fmting_lit[1];
            $pp_print_char($ppf, 64);
            return $pp_print_char($ppf, $c);
          }
      }
    };
    $output_acc->contents = function(dynamic $ppf, dynamic $acc) use ($CamlinternalFormat,$Pervasives,$String,$call1,$call2,$compute_tag,$is_int,$output_acc,$output_formatting_lit,$pp_open_box_gen,$pp_open_tag,$pp_print_as_size,$pp_print_char,$pp_print_flush,$pp_print_string) {
      if ($is_int($acc)) {return 0;}
      else {
        switch($acc[0]) {
          // FALLTHROUGH
          case 0:
            $f = $acc[2];
            $p = $acc[1];
            $output_acc->contents($ppf, $p);
            return $output_formatting_lit($ppf, $f);
          // FALLTHROUGH
          case 1:
            $to = $acc[2];
            $tp = $acc[1];
            if (0 === $to[0]) {
              $acc__0 = $to[1];
              $output_acc->contents($ppf, $tp);
              return $pp_open_tag(
                $ppf,
                $compute_tag($output_acc->contents, $acc__0)
              );
            }
            $acc__1 = $to[1];
            $output_acc->contents($ppf, $tp);
            $tq = $compute_tag($output_acc->contents, $acc__1);
            $match = $call1($CamlinternalFormat[21], $tq);
            $bty = $match[2];
            $indent = $match[1];
            return $pp_open_box_gen($ppf, $indent, $bty);
          // FALLTHROUGH
          case 2:
            $tr = $acc[1];
            if ($is_int($tr)) {$switch__1 = 1;}
            else {
              if (0 === $tr[0]) {
                $tt = $tr[2];
                if ($is_int($tt)) {$switch__2 = 1;}
                else {
                  if (1 === $tt[0]) {
                    $tu = $acc[2];
                    $tv = $tt[2];
                    $tw = $tr[1];
                    $s__0 = $tu;
                    $size = $tv;
                    $p__1 = $tw;
                    $switch__0 = 0;
                    $switch__1 = 0;
                    $switch__2 = 0;
                  }
                  else {$switch__2 = 1;}
                }
                if ($switch__2) {$switch__1 = 1;}
              }
              else {$switch__1 = 1;}
            }
            if ($switch__1) {
              $ts = $acc[2];
              $s = $ts;
              $p__0 = $tr;
              $switch__0 = 2;
            }
            break;
          // FALLTHROUGH
          case 3:
            $tx = $acc[1];
            if ($is_int($tx)) {$switch__3 = 1;}
            else {
              if (0 === $tx[0]) {
                $tz = $tx[2];
                if ($is_int($tz)) {$switch__4 = 1;}
                else {
                  if (1 === $tz[0]) {
                    $tA = $acc[2];
                    $tB = $tz[2];
                    $tC = $tx[1];
                    $c__0 = $tA;
                    $size__0 = $tB;
                    $p__3 = $tC;
                    $switch__0 = 1;
                    $switch__3 = 0;
                    $switch__4 = 0;
                  }
                  else {$switch__4 = 1;}
                }
                if ($switch__4) {$switch__3 = 1;}
              }
              else {$switch__3 = 1;}
            }
            if ($switch__3) {
              $ty = $acc[2];
              $c = $ty;
              $p__2 = $tx;
              $switch__0 = 3;
            }
            break;
          // FALLTHROUGH
          case 4:
            $tD = $acc[1];
            if ($is_int($tD)) {$switch__5 = 1;}
            else {
              if (0 === $tD[0]) {
                $tF = $tD[2];
                if ($is_int($tF)) {$switch__6 = 1;}
                else {
                  if (1 === $tF[0]) {
                    $tG = $acc[2];
                    $tH = $tF[2];
                    $tI = $tD[1];
                    $s__0 = $tG;
                    $size = $tH;
                    $p__1 = $tI;
                    $switch__0 = 0;
                    $switch__5 = 0;
                    $switch__6 = 0;
                  }
                  else {$switch__6 = 1;}
                }
                if ($switch__6) {$switch__5 = 1;}
              }
              else {$switch__5 = 1;}
            }
            if ($switch__5) {
              $tE = $acc[2];
              $s = $tE;
              $p__0 = $tD;
              $switch__0 = 2;
            }
            break;
          // FALLTHROUGH
          case 5:
            $tJ = $acc[1];
            if ($is_int($tJ)) {$switch__7 = 1;}
            else {
              if (0 === $tJ[0]) {
                $tL = $tJ[2];
                if ($is_int($tL)) {$switch__8 = 1;}
                else {
                  if (1 === $tL[0]) {
                    $tM = $acc[2];
                    $tN = $tL[2];
                    $tO = $tJ[1];
                    $c__0 = $tM;
                    $size__0 = $tN;
                    $p__3 = $tO;
                    $switch__0 = 1;
                    $switch__7 = 0;
                    $switch__8 = 0;
                  }
                  else {$switch__8 = 1;}
                }
                if ($switch__8) {$switch__7 = 1;}
              }
              else {$switch__7 = 1;}
            }
            if ($switch__7) {
              $tK = $acc[2];
              $c = $tK;
              $p__2 = $tJ;
              $switch__0 = 3;
            }
            break;
          // FALLTHROUGH
          case 6:
            $f__0 = $acc[2];
            $p__4 = $acc[1];
            $output_acc->contents($ppf, $p__4);
            return $call1($f__0, $ppf);
          // FALLTHROUGH
          case 7:
            $p__5 = $acc[1];
            $output_acc->contents($ppf, $p__5);
            return $pp_print_flush($ppf, 0);
          // FALLTHROUGH
          default:
            $msg = $acc[2];
            $p__6 = $acc[1];
            $output_acc->contents($ppf, $p__6);
            return $call1($Pervasives[1], $msg);
          }
      }
      switch($switch__0) {
        // FALLTHROUGH
        case 0:
          $output_acc->contents($ppf, $p__1);
          return $pp_print_as_size($ppf, $size, $s__0);
        // FALLTHROUGH
        case 1:
          $output_acc->contents($ppf, $p__3);
          return $pp_print_as_size(
            $ppf,
            $size__0,
            $call2($String[1], 1, $c__0)
          );
        // FALLTHROUGH
        case 2:
          $output_acc->contents($ppf, $p__0);
          return $pp_print_string($ppf, $s);
        // FALLTHROUGH
        default:
          $output_acc->contents($ppf, $p__2);
          return $pp_print_char($ppf, $c);
        }
    };
    $strput_acc->contents = function(dynamic $ppf, dynamic $acc) use ($CamlinternalFormat,$Pervasives,$String,$call1,$call2,$compute_tag,$is_int,$output_formatting_lit,$pp_open_box_gen,$pp_open_tag,$pp_print_as_size,$pp_print_char,$pp_print_flush,$pp_print_string,$strput_acc) {
      if ($is_int($acc)) {return 0;}
      else {
        switch($acc[0]) {
          // FALLTHROUGH
          case 0:
            $f = $acc[2];
            $p = $acc[1];
            $strput_acc->contents($ppf, $p);
            return $output_formatting_lit($ppf, $f);
          // FALLTHROUGH
          case 1:
            $sW = $acc[2];
            $sX = $acc[1];
            if (0 === $sW[0]) {
              $acc__0 = $sW[1];
              $strput_acc->contents($ppf, $sX);
              return $pp_open_tag(
                $ppf,
                $compute_tag($strput_acc->contents, $acc__0)
              );
            }
            $acc__1 = $sW[1];
            $strput_acc->contents($ppf, $sX);
            $sY = $compute_tag($strput_acc->contents, $acc__1);
            $match = $call1($CamlinternalFormat[21], $sY);
            $bty = $match[2];
            $indent = $match[1];
            return $pp_open_box_gen($ppf, $indent, $bty);
          // FALLTHROUGH
          case 2:
            $sZ = $acc[1];
            if ($is_int($sZ)) {$switch__1 = 1;}
            else {
              if (0 === $sZ[0]) {
                $s1 = $sZ[2];
                if ($is_int($s1)) {$switch__2 = 1;}
                else {
                  if (1 === $s1[0]) {
                    $s2 = $acc[2];
                    $s3 = $s1[2];
                    $s4 = $sZ[1];
                    $s__0 = $s2;
                    $size = $s3;
                    $p__1 = $s4;
                    $switch__0 = 0;
                    $switch__1 = 0;
                    $switch__2 = 0;
                  }
                  else {$switch__2 = 1;}
                }
                if ($switch__2) {$switch__1 = 1;}
              }
              else {$switch__1 = 1;}
            }
            if ($switch__1) {
              $s0 = $acc[2];
              $s = $s0;
              $p__0 = $sZ;
              $switch__0 = 2;
            }
            break;
          // FALLTHROUGH
          case 3:
            $s5 = $acc[1];
            if ($is_int($s5)) {$switch__3 = 1;}
            else {
              if (0 === $s5[0]) {
                $s7 = $s5[2];
                if ($is_int($s7)) {$switch__4 = 1;}
                else {
                  if (1 === $s7[0]) {
                    $s8 = $acc[2];
                    $s9 = $s7[2];
                    $s_ = $s5[1];
                    $c__0 = $s8;
                    $size__0 = $s9;
                    $p__3 = $s_;
                    $switch__0 = 1;
                    $switch__3 = 0;
                    $switch__4 = 0;
                  }
                  else {$switch__4 = 1;}
                }
                if ($switch__4) {$switch__3 = 1;}
              }
              else {$switch__3 = 1;}
            }
            if ($switch__3) {
              $s6 = $acc[2];
              $c = $s6;
              $p__2 = $s5;
              $switch__0 = 3;
            }
            break;
          // FALLTHROUGH
          case 4:
            $ta = $acc[1];
            if ($is_int($ta)) {$switch__5 = 1;}
            else {
              if (0 === $ta[0]) {
                $tc = $ta[2];
                if ($is_int($tc)) {$switch__6 = 1;}
                else {
                  if (1 === $tc[0]) {
                    $td = $acc[2];
                    $te = $tc[2];
                    $tf = $ta[1];
                    $s__0 = $td;
                    $size = $te;
                    $p__1 = $tf;
                    $switch__0 = 0;
                    $switch__5 = 0;
                    $switch__6 = 0;
                  }
                  else {$switch__6 = 1;}
                }
                if ($switch__6) {$switch__5 = 1;}
              }
              else {$switch__5 = 1;}
            }
            if ($switch__5) {
              $tb = $acc[2];
              $s = $tb;
              $p__0 = $ta;
              $switch__0 = 2;
            }
            break;
          // FALLTHROUGH
          case 5:
            $tg = $acc[1];
            if ($is_int($tg)) {$switch__7 = 1;}
            else {
              if (0 === $tg[0]) {
                $ti = $tg[2];
                if ($is_int($ti)) {$switch__8 = 1;}
                else {
                  if (1 === $ti[0]) {
                    $tj = $acc[2];
                    $tk = $ti[2];
                    $tl = $tg[1];
                    $c__0 = $tj;
                    $size__0 = $tk;
                    $p__3 = $tl;
                    $switch__0 = 1;
                    $switch__7 = 0;
                    $switch__8 = 0;
                  }
                  else {$switch__8 = 1;}
                }
                if ($switch__8) {$switch__7 = 1;}
              }
              else {$switch__7 = 1;}
            }
            if ($switch__7) {
              $th = $acc[2];
              $c = $th;
              $p__2 = $tg;
              $switch__0 = 3;
            }
            break;
          // FALLTHROUGH
          case 6:
            $tm = $acc[1];
            if (! $is_int($tm) && 0 === $tm[0]) {
              $tn = $tm[2];
              if (! $is_int($tn) && 1 === $tn[0]) {
                $f__1 = $acc[2];
                $size__1 = $tn[2];
                $p__4 = $tm[1];
                $strput_acc->contents($ppf, $p__4);
                return $pp_print_as_size($ppf, $size__1, $call1($f__1, 0));
              }
            }
            $f__0 = $acc[2];
            $strput_acc->contents($ppf, $tm);
            return $pp_print_string($ppf, $call1($f__0, 0));
          // FALLTHROUGH
          case 7:
            $p__5 = $acc[1];
            $strput_acc->contents($ppf, $p__5);
            return $pp_print_flush($ppf, 0);
          // FALLTHROUGH
          default:
            $msg = $acc[2];
            $p__6 = $acc[1];
            $strput_acc->contents($ppf, $p__6);
            return $call1($Pervasives[1], $msg);
          }
      }
      switch($switch__0) {
        // FALLTHROUGH
        case 0:
          $strput_acc->contents($ppf, $p__1);
          return $pp_print_as_size($ppf, $size, $s__0);
        // FALLTHROUGH
        case 1:
          $strput_acc->contents($ppf, $p__3);
          return $pp_print_as_size(
            $ppf,
            $size__0,
            $call2($String[1], 1, $c__0)
          );
        // FALLTHROUGH
        case 2:
          $strput_acc->contents($ppf, $p__0);
          return $pp_print_string($ppf, $s);
        // FALLTHROUGH
        default:
          $strput_acc->contents($ppf, $p__2);
          return $pp_print_char($ppf, $c);
        }
    };
    $kfprintf = function(dynamic $k, dynamic $ppf, dynamic $param) use ($CamlinternalFormat,$call1,$call4,$output_acc) {
      $fmt = $param[1];
      $sU = 0;
      $sV = function(dynamic $ppf, dynamic $acc) use ($call1,$k,$output_acc) {
        $output_acc->contents($ppf, $acc);
        return $call1($k, $ppf);
      };
      return $call4($CamlinternalFormat[7], $sV, $ppf, $sU, $fmt);
    };
    $ikfprintf = function(dynamic $k, dynamic $ppf, dynamic $param) use ($CamlinternalFormat,$call3) {
      $fmt = $param[1];
      return $call3($CamlinternalFormat[8], $k, $ppf, $fmt);
    };
    $fprintf = function(dynamic $ppf) use ($kfprintf) {
      $sR = function(dynamic $sT) {return 0;};
      return function(dynamic $sS) use ($kfprintf,$ppf,$sR) {
        return $kfprintf($sR, $ppf, $sS);
      };
    };
    $ifprintf = function(dynamic $ppf) use ($ikfprintf) {
      $sO = function(dynamic $sQ) {return 0;};
      return function(dynamic $sP) use ($ikfprintf,$ppf,$sO) {
        return $ikfprintf($sO, $ppf, $sP);
      };
    };
    $printf = function(dynamic $fmt) use ($call1,$fprintf,$std_formatter) {
      return $call1($fprintf($std_formatter), $fmt);
    };
    $eprintf = function(dynamic $fmt) use ($call1,$err_formatter,$fprintf) {
      return $call1($fprintf($err_formatter), $fmt);
    };
    $ksprintf = function(dynamic $k, dynamic $param) use ($CamlinternalFormat,$call1,$call4,$flush_buffer_formatter,$formatter_of_buffer,$pp_make_buffer,$strput_acc) {
      $fmt = $param[1];
      $b = $pp_make_buffer(0);
      $ppf = $formatter_of_buffer($b);
      $k__0 = function(dynamic $param, dynamic $acc) use ($b,$call1,$flush_buffer_formatter,$k,$ppf,$strput_acc) {
        $strput_acc->contents($ppf, $acc);
        return $call1($k, $flush_buffer_formatter($b, $ppf));
      };
      return $call4($CamlinternalFormat[7], $k__0, 0, 0, $fmt);
    };
    $sprintf = function(dynamic $fmt) use ($ksprintf) {
      return $ksprintf(function(dynamic $s) {return $s;}, $fmt);
    };
    $kasprintf = function(dynamic $k, dynamic $param) use ($CamlinternalFormat,$call1,$call4,$flush_buffer_formatter,$formatter_of_buffer,$output_acc,$pp_make_buffer) {
      $fmt = $param[1];
      $b = $pp_make_buffer(0);
      $ppf = $formatter_of_buffer($b);
      $k__0 = function(dynamic $ppf, dynamic $acc) use ($b,$call1,$flush_buffer_formatter,$k,$output_acc) {
        $output_acc->contents($ppf, $acc);
        return $call1($k, $flush_buffer_formatter($b, $ppf));
      };
      return $call4($CamlinternalFormat[7], $k__0, $ppf, 0, $fmt);
    };
    $asprintf = function(dynamic $fmt) use ($kasprintf) {
      return $kasprintf(function(dynamic $s) {return $s;}, $fmt);
    };
    
    $call1($Pervasives[88], $print_flush);
    
    $pp_set_all_formatter_output_functions = function
    (dynamic $state, dynamic $f, dynamic $g, dynamic $h, dynamic $i) use ($pp_set_formatter_output_functions) {
      $pp_set_formatter_output_functions($state, $f, $g);
      $state[19] = $h;
      $state[20] = $i;
      return 0;
    };
    $pp_get_all_formatter_output_functions = function
    (dynamic $state, dynamic $param) {
      return Vector{0, $state[17], $state[18], $state[19], $state[20]};
    };
    $set_all_formatter_output_functions = function
    (dynamic $sK, dynamic $sL, dynamic $sM, dynamic $sN) use ($pp_set_all_formatter_output_functions,$std_formatter) {
      return $pp_set_all_formatter_output_functions(
        $std_formatter,
        $sK,
        $sL,
        $sM,
        $sN
      );
    };
    $get_all_formatter_output_functions = function(dynamic $sJ) use ($pp_get_all_formatter_output_functions,$std_formatter) {
      return $pp_get_all_formatter_output_functions($std_formatter, $sJ);
    };
    $bprintf = function(dynamic $b, dynamic $param) use ($CamlinternalFormat,$call4,$formatter_of_buffer,$output_acc,$pp_flush_queue) {
      $fmt = $param[1];
      $k = function(dynamic $ppf, dynamic $acc) use ($output_acc,$pp_flush_queue) {
        $output_acc->contents($ppf, $acc);
        return $pp_flush_queue($ppf, 0);
      };
      $sI = $formatter_of_buffer($b);
      return $call4($CamlinternalFormat[7], $k, $sI, 0, $fmt);
    };
    $Format = Vector{
      0,
      $pp_open_box,
      $open_box,
      $pp_close_box,
      $close_box,
      $pp_open_hbox,
      $open_hbox,
      $pp_open_vbox,
      $open_vbox,
      $pp_open_hvbox,
      $open_hvbox,
      $pp_open_hovbox,
      $open_hovbox,
      $pp_print_string,
      $print_string,
      $pp_print_as,
      $print_as,
      $pp_print_int,
      $print_int,
      $pp_print_float,
      $print_float,
      $pp_print_char,
      $print_char,
      $pp_print_bool,
      $print_bool,
      $pp_print_space,
      $print_space,
      $pp_print_cut,
      $print_cut,
      $pp_print_break,
      $print_break,
      $pp_force_newline,
      $force_newline,
      $pp_print_if_newline,
      $print_if_newline,
      $pp_print_flush,
      $print_flush,
      $pp_print_newline,
      $print_newline,
      $pp_set_margin,
      $set_margin,
      $pp_get_margin,
      $get_margin,
      $pp_set_max_indent,
      $set_max_indent,
      $pp_get_max_indent,
      $get_max_indent,
      $pp_set_max_boxes,
      $set_max_boxes,
      $pp_get_max_boxes,
      $get_max_boxes,
      $pp_over_max_boxes,
      $over_max_boxes,
      $pp_open_tbox,
      $open_tbox,
      $pp_close_tbox,
      $close_tbox,
      $pp_set_tab,
      $set_tab,
      $pp_print_tab,
      $print_tab,
      $pp_print_tbreak,
      $print_tbreak,
      $pp_set_ellipsis_text,
      $set_ellipsis_text,
      $pp_get_ellipsis_text,
      $get_ellipsis_text,
      $pp_open_tag,
      $open_tag,
      $pp_close_tag,
      $close_tag,
      $pp_set_tags,
      $set_tags,
      $pp_set_print_tags,
      $set_print_tags,
      $pp_set_mark_tags,
      $set_mark_tags,
      $pp_get_print_tags,
      $get_print_tags,
      $pp_get_mark_tags,
      $get_mark_tags,
      $pp_set_formatter_out_channel,
      $set_formatter_out_channel,
      $pp_set_formatter_output_functions,
      $set_formatter_output_functions,
      $pp_get_formatter_output_functions,
      $get_formatter_output_functions,
      $pp_set_formatter_out_functions,
      $set_formatter_out_functions,
      $pp_get_formatter_out_functions,
      $get_formatter_out_functions,
      $pp_set_formatter_tag_functions,
      $set_formatter_tag_functions,
      $pp_get_formatter_tag_functions,
      $get_formatter_tag_functions,
      $formatter_of_out_channel,
      $std_formatter,
      $err_formatter,
      $formatter_of_buffer,
      $stdbuf,
      $str_formatter,
      $flush_str_formatter,
      $make_formatter,
      $formatter_of_out_functions,
      $make_symbolic_output_buffer,
      $clear_symbolic_output_buffer,
      $get_symbolic_output_buffer,
      $flush_symbolic_output_buffer,
      $add_symbolic_output_item,
      $formatter_of_symbolic_output_buffer,
      $pp_print_list,
      $pp_print_text,
      $fprintf,
      $printf,
      $eprintf,
      $sprintf,
      $asprintf,
      $ifprintf,
      $kfprintf,
      $ikfprintf,
      $ksprintf,
      $kasprintf,
      $bprintf,
      $ksprintf,
      $set_all_formatter_output_functions,
      $get_all_formatter_output_functions,
      $pp_set_all_formatter_output_functions,
      $pp_get_all_formatter_output_functions
    };
    
    $runtime["caml_register_global"](15, $Format, "Format");

  }
}