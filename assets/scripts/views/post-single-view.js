'use strict';

import View from './view'
import template from '../../../templates/content-single.mustache'
import entryMetaPartial from '../../../templates/entry-meta.mustache'
var partials = {
  'entry-meta': entryMetaPartial
}

export default class PostSingleView extends View {
  constructor (options) {
    super(options)
    this.template = template
    this.partials = partials
  }
}