<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2008 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class Albums_Controller extends Items_Controller {

  /**
   *  @see Rest_Controller::_show($resource, $output_format)
   */
  public function _show($item, $output_format) {
    // @todo: these need to be pulled from the database
    $theme_name = "default";
    $page_size = 9;

    $template = new View("page.html");

    $page = $this->input->get("page", "1");
    $theme = new Theme($theme_name, $template);

    $template->set_global('page_size', $page_size);
    $template->set_global('item', $item);
    $template->set_global('children', $item->children($page_size, ($page-1) * $page_size));
    $template->set_global('parents', $item->parents());
    $template->set_global('theme', $theme);
    $template->set_global('user', Session::instance()->get('user', null));
    $template->content = new View("album.html");

    print $template;
  }
}