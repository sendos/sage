'use strict'

import Chap from '../chap'

export default class Layout extends Chap.Layout {
  constructor() {
    super()
  }

  openLink(event) {
    if (Chap.utils.modifierKeyPressed(event)) {
      return
    }

    var el = event.currentTarget
    var href = el.getAttribute('href')
    var jsonURL = el.getAttribute('data-json-url')

    if (!href) {
      return
    }

    Chap.utils.redirectTo({
      url: href
    }, { 
      jsonURL: jsonURL
    })
    event.preventDefault()
  }
}