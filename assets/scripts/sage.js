'use strict'

import Chap from './chap'
import Layout from './views/layout'

export default class Sage extends Chap.Application {
  constructor(options) {
    super(options)
  }

  initLayout(options) {
    this.layout = new Layout(options)
  }
}