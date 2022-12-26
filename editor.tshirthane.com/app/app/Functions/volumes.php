<?php function volumes() {
    return db("volumes")->where("y",1)->get();
} ?>