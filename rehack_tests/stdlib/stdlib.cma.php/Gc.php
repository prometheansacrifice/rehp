<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Gc.php
 */

namespace Rehack;

final class Gc {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Printf = Printf::get();
    $Sys = Sys::get();
    Gc::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Gc;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $call2 = $runtime["caml_call2"];
    $call3 = $runtime["caml_call3"];
    $call4 = $runtime["caml_call4"];
    $caml_ml_string_length = $runtime["caml_ml_string_length"];
    $string = $runtime["caml_new_string"];
    $global_data = $runtime["caml_get_global_data"]();
    $Sys = $global_data["Sys"];
    $Printf = $global_data["Printf"];
    $ps = Vector{
      0,
      Vector{
        11,
        $string("minor_collections: "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("minor_collections: %d\n")
    };
    $pt = Vector{
      0,
      Vector{
        11,
        $string("major_collections: "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("major_collections: %d\n")
    };
    $pu = Vector{
      0,
      Vector{
        11,
        $string("compactions:       "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("compactions:       %d\n")
    };
    $pv = Vector{0, Vector{12, 10, 0}, $string("\n")};
    $pw = Vector{0, Vector{8, 0, 0, Vector{0, 0}, 0}, $string("%.0f")};
    $px = Vector{
      0,
      Vector{
        11,
        $string("minor_words:    "),
        Vector{8, 0, Vector{1, 1}, Vector{0, 0}, Vector{12, 10, 0}}
      },
      $string("minor_words:    %*.0f\n")
    };
    $py = Vector{
      0,
      Vector{
        11,
        $string("promoted_words: "),
        Vector{8, 0, Vector{1, 1}, Vector{0, 0}, Vector{12, 10, 0}}
      },
      $string("promoted_words: %*.0f\n")
    };
    $pz = Vector{
      0,
      Vector{
        11,
        $string("major_words:    "),
        Vector{8, 0, Vector{1, 1}, Vector{0, 0}, Vector{12, 10, 0}}
      },
      $string("major_words:    %*.0f\n")
    };
    $pA = Vector{0, Vector{12, 10, 0}, $string("\n")};
    $pB = Vector{0, Vector{4, 0, 0, 0, 0}, $string("%d")};
    $pC = Vector{
      0,
      Vector{
        11,
        $string("top_heap_words: "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("top_heap_words: %*d\n")
    };
    $pD = Vector{
      0,
      Vector{
        11,
        $string("heap_words:     "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("heap_words:     %*d\n")
    };
    $pE = Vector{
      0,
      Vector{
        11,
        $string("live_words:     "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("live_words:     %*d\n")
    };
    $pF = Vector{
      0,
      Vector{
        11,
        $string("free_words:     "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("free_words:     %*d\n")
    };
    $pG = Vector{
      0,
      Vector{
        11,
        $string("largest_free:   "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("largest_free:   %*d\n")
    };
    $pH = Vector{
      0,
      Vector{
        11,
        $string("fragments:      "),
        Vector{4, 0, Vector{1, 1}, 0, Vector{12, 10, 0}}
      },
      $string("fragments:      %*d\n")
    };
    $pI = Vector{0, Vector{12, 10, 0}, $string("\n")};
    $pJ = Vector{
      0,
      Vector{
        11,
        $string("live_blocks: "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("live_blocks: %d\n")
    };
    $pK = Vector{
      0,
      Vector{
        11,
        $string("free_blocks: "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("free_blocks: %d\n")
    };
    $pL = Vector{
      0,
      Vector{
        11,
        $string("heap_chunks: "),
        Vector{4, 0, 0, 0, Vector{12, 10, 0}}
      },
      $string("heap_chunks: %d\n")
    };
    $print_stat = function(dynamic $c) use ($Printf,$call2,$call3,$call4,$caml_ml_string_length,$pA,$pB,$pC,$pD,$pE,$pF,$pG,$pH,$pI,$pJ,$pK,$pL,$ps,$pt,$pu,$pv,$pw,$px,$py,$pz,$runtime) {
      $st = $runtime["caml_gc_stat"](0);
      $call3($Printf[1], $c, $ps, $st[4]);
      $call3($Printf[1], $c, $pt, $st[5]);
      $call3($Printf[1], $c, $pu, $st[14]);
      $call2($Printf[1], $c, $pv);
      $l1 = $caml_ml_string_length($call2($Printf[4], $pw, $st[1]));
      $call4($Printf[1], $c, $px, $l1, $st[1]);
      $call4($Printf[1], $c, $py, $l1, $st[2]);
      $call4($Printf[1], $c, $pz, $l1, $st[3]);
      $call2($Printf[1], $c, $pA);
      $l2 = $caml_ml_string_length($call2($Printf[4], $pB, $st[15]));
      $call4($Printf[1], $c, $pC, $l2, $st[15]);
      $call4($Printf[1], $c, $pD, $l2, $st[6]);
      $call4($Printf[1], $c, $pE, $l2, $st[8]);
      $call4($Printf[1], $c, $pF, $l2, $st[10]);
      $call4($Printf[1], $c, $pG, $l2, $st[12]);
      $call4($Printf[1], $c, $pH, $l2, $st[13]);
      $call2($Printf[1], $c, $pI);
      $call3($Printf[1], $c, $pJ, $st[9]);
      $call3($Printf[1], $c, $pK, $st[11]);
      return $call3($Printf[1], $c, $pL, $st[7]);
    };
    $allocated_bytes = function(dynamic $param) use ($Sys,$runtime) {
      $match = $runtime["caml_gc_counters"](0);
      $ma = $match[3];
      $pro = $match[2];
      $mi = $match[1];
      return ($mi + $ma - $pro) * (int) ($Sys[10] / 8);
    };
    $create_alarm = function(dynamic $f) {return Vector{0, 1};};
    $delete_alarm = function(dynamic $a) {$a[1] = 0;return 0;};
    $pM = function(dynamic $pS) use ($runtime) {
      return $runtime["caml_final_release"]($pS);
    };
    $pN = function(dynamic $pR, dynamic $pQ) use ($runtime) {
      return $runtime["caml_final_register_called_without_value"]($pR, $pQ);
    };
    $Gc = Vector{
      0,
      $print_stat,
      $allocated_bytes,
      function(dynamic $pP, dynamic $pO) use ($runtime) {
        return $runtime["caml_final_register"]($pP, $pO);
      },
      $pN,
      $pM,
      $create_alarm,
      $delete_alarm
    };
    
    $runtime["caml_register_global"](22, $Gc, "Gc");

  }
}