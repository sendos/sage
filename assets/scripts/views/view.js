'use strict'

import Chap from '../chap'
import Hogan from 'hogan.js'
import _ from 'underscore'

export default class View extends Chap.View {
  constructor(options) {
    super(options)
  }

  getTemplateFunction() {
    return this.template.render.bind(this.template)
  } 

  render() {
    var func = this.getTemplateFunction()
    var html = func(this.getTemplateData(), this.partials)
    this.$el.html(html)
  }
}
