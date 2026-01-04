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

// 屏幕适配
;(function flexible(window, document) {
  const docEl = document.documentElement

  // 设计稿基准宽度，一般是 375 或 750
  const designWidth = 375
  // 最大宽度，可以根据需求设置
  const maxWidth = 750
  // 最小宽度
  const minWidth = 320

  // 计算、设置 rem
  function setRemUnit() {
    // 获取当前设备宽度
    let clientWidth = docEl.clientWidth

    // 限制最大最小宽度
    clientWidth = Math.min(clientWidth, maxWidth)
    clientWidth = Math.max(clientWidth, minWidth)

    // 计算 rem 基准值 (以 100px 为基准)
    // 如果设计稿是 375px，那么 1rem = 100px
    // 比如在设计稿中元素宽度是 75px，那么在 css 中就写成 0.75rem
    const rem = (clientWidth * 16) / designWidth

    // 设置 rem
    docEl.style.fontSize = rem + 'px'
  }

  // 监听窗口变化
  window.addEventListener('resize', setRemUnit)
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      setRemUnit()
    }
  })

  // 初始化执行一次
  setRemUnit()

  // 设置 body 的字体大小，避免 rem 对字体大小的影响
  if (document.readyState === 'complete') {
    document.body.style.fontSize = '14px'
  } else {
    document.addEventListener('DOMContentLoaded', function () {
      document.body.style.fontSize = '14px'
    })
  }
})(window, document)
