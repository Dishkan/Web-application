<h2>Вход на сайт</h2>
			 %message_auth%
			 <form name="auth" action="functions.php" method="post">
			     <table>
				    <tr>
					    <td>Логин:</td>
						<td>
						   <input type="text" name="login" />						   
						</td>
					</tr>
				    <tr>
					    <td>Пароль:</td>
						<td>
						   <input type="password" name="password" />						   
						</td>
					</tr>
                    <tr>
                        <td colspan="2" align="right">
						   <input type="submit" name="auth" value="Войти" />
						</td>
                    </tr>
                    <tr>
					   <td colspan="2" align="right">
					       <a href="%address%?view=reg">Зарегистрироваться</a>
					   </td>
                    </tr>
                    <tr>
					   <td colspan="2" align="right">
					       <a href="%address%?view=password">Забыли пароль?</a>
					   </td>
                    </tr>					
				 </table>
			 </form>