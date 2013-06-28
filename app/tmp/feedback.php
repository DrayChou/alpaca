<div class="content simple">
  <h1>
    <?=$title?></h1>
  <form id="purchase-form" class="purchase-form" method="POST" action="<?=BASE?>
    freeform/index/留言板/">
    <div class="basic">
      <div class="tr fd-clr">
        <div class="key">
          产品名称 <b>*</b>
        </div>
        <div class="value offername-value">
          <input type="text" maxlength="30" placeholder="如:采购USB2.0连接插座" class="text shadow" data-name="offerName" value="" name="货物名称">
          <div id="offername-tip" class="highlight offername-tip">
            <p>如:采购USB2.0连接插座</p>
            <span class="left-arrow"></span>
          </div>
        </div>
      </div>
      <div class="tr fd-clr">
        <div class="key">
          采购数量 <b>*</b>
        </div>
        <div class="value">
          <input type="text" placeholder="数量" data-name="amount" class="text amount shadow" value="" name="数量">
          <input type="text" maxlength="10" placeholder="单位" data-name="unit" class="text unit shadow" value="" name="单位"></div>
      </div>
      <div class="tr fd-clr">
        <div class="key">
          询价单有效期
          <b>*</b>
        </div>
        <div class="value">
          <select class="shadow" id="deadline" name="询价有效期">
            <option value="3">三天内</option>
            <option value="7">一周内</option>
            <option value="14">两周内</option>
            <option value="30">三十天内</option>
          </select>
        </div>
      </div>

      <div class="tr fd-clr">
        <div class="key">
          详细说明
          <b>&nbsp;</b>
        </div>
        <div class="value">
          <div class="fd-clr" id="common-word">
            <span data-process-monitor="app=bing&amp;page_type=post&amp;source=winport&amp;action=common&amp;buyerID=" style="float:left;" class="btn btn1"></span>
            <span class="btn btn2"></span>
            <select name="主题" >
              <option>紧急采购！</option>
              <option>请报实价</option>
              <option>请速传真报价</option>
              <option>请速来电话联系</option>
              <option>有货立刻来电话</option>
              <option>只求有货，价钱好商量</option>
              <option>报价请注明是否含税</option>
              <option>要增值税发票</option>
              <option>实单采购</option>
              <option>后期需打样</option>
              <option>必须指定品牌！</option>
              <option>要求全新原装</option>
            </select>
          </div>
          <textarea name="留言内容" cols="50" rows="5"></textarea>
        </div>
      </div>
      <div class="tr fd-clr">
        <div class="key">
          联系人
          <b>*</b>
        </div>
        <div class="value">
          <input type="text" maxlength="32" data-name="contactName" class="text shadow" value="" name="联系人"></div>
      </div>
      <div class="tr fd-clr">
        <div class="key">
          联系电话
          <b>*</b>
        </div>
        <div class="value">
          <input type="text" maxlength="30" data-name="telephone" class="text shadow" value="" name="联系电话"></div>
      </div>
      <input type="hidden" id="recommend-input" value="false" name="_fm.p._0.en"></div>

    <div class="tr form-footer fd-clr">
      <div class="key">
        <b>&nbsp;</b>
      </div>
      <div class="value">
        <ul>
          <li class="btn fd-clr">
            <input type="submit" value="保存并发送" ></li>
        </ul>
      </div>
    </div>
  </form>
</div>