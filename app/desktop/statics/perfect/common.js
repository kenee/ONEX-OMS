/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

(function () {

  document.body.addEventListener('click', onClickBody)

  var quickMenuBtn = document.querySelector('#quick-menu-btn')
  quickMenuBtn.addEventListener('click', onOpenQuickDrawer)

  function onClickBody() {
    var e = window.event
    var drawer = document.querySelector('#quick-drawer')
    if (
      !quickMenuBtn.contains(e.target)
      && quickMenuBtn !== e.target
      && drawer !== e.target
      && !drawer.contains(e.target)
      && drawer.style.right === '0px'
    ) {
      onOpenQuickDrawer()
    }
  }

  /**
   * 打开快捷操作侧边栏
   */
  function onOpenQuickDrawer() {
    var drawer = document.querySelector('#quick-drawer')
    drawer.style.right = drawer.style.right === '0px' ?  '-550px' : '0px'
  }
})()

